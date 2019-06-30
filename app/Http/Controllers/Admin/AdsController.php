<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use App\Ad;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AdsController extends BaseController
{
    public function index()
    {
        if (current_user()->type === 1) {
            if (current_user()->isPremium()){
                $ads = current_user()->ads()->latest()->paginate(10);
            } else {
                abort(404);
            }
        } else {
            $ads = Ad::all();
        }
        return view('admin.ads.index', compact('ads'));
    }

    public function create()
    {
        if (!current_user()->isPremium()){
            abort(404);
        }
        return view('admin.ads.create');
    }

    public function store(Request $request)
    {
        if (!current_user()->isPremium()){
            abort(404);
        }
        $request->validate([
            "title" => "required_without_all:description,attachment",
            "size" => "required|string",
            "url" => "required|string",
            "duration" => "required|string",
            "description" => "required_without_all:title,attachment",
            //"status" => "required|string",
            "attachment" => "required_without_all:title,description|file|image"
       ]);

        $path = null;
        if ($request->attachment) {
            $path = $request->attachment->store('public/ad-attachments');
            $prefix = 'public/';
            if (substr($path, 0, strlen($prefix)) == $prefix) {
                $path = substr($path, strlen($prefix));
            }
        }

        $status = "Pending";
        if (auth()->user()->isAdmin()) {
            $status = "Approved";
        }
        $size_array = explode("x", $request->size);
        $width = (int) $size_array[0];
        $height = (int) $size_array[1];
        $price = 0;
        switch($request->duration) {
            case "Week":
                $price = 897.12;
                break;
            case "Month":
                $price = 3588.48;
                break;
            case "Year":
                $price = 43061.76;
                break;
            default:
                break;
        }

        $ad = Ad::create([
            "user_id" => current_user()->id,
            "title" => $request->title,
            "size" => $request->size,
            "height" => $height,
            "width" => $width,
            "url" => $request->url,
            "description" => $request->description,
            "status" => $status,
            "attachment" => $path,
            "duration" => $request->duration,
            "price" => $price,
        ]);

        if (auth()->user()->isAdmin()) {
            session()->flash('message-success', "Ad created!");
            $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " created a new Ad (AD ID#" . $ad->id . ").");
        } else {
            session()->flash('message-success', "Ad requested!");
            $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " requested a new Ad (AD ID#" . $ad->id . ").");
        }
        return redirect('admin/ads');
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request, Ad $ad)
    {
        if (current_user()->type !== 0) {
            if (!current_user()->isPremium() && $ad->user_id !== current_user()->id){
                abort(404);
            }
        }
        return view('admin.ads.edit', compact('ad'));
    }

    public function approve(Request $request, Ad $ad)
    {
        if (current_user()->type !== 0) {
            abort(404);
        }
        $ad->status = "Approved";
        $expiration_date = null;
        switch($ad->duration) {
            case "Week":
                $expiration_date = Carbon::now()->addWeek();
                break;
            case "Month":
                $expiration_date = Carbon::now()->addMonth();
                break;
            case "Year":
                $expiration_date = Carbon::now()->addYear();
                break;
            default:
                break;
        }
        $ad->expiration_date = $expiration_date;
        $ad->save();
        session()->flash('message-success', "Ad approved!");
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " approved Ad (AD ID#" . $ad->id . ").");
        return back();
    }

    public function reject(Request $request, Ad $ad)
    {
        if (current_user()->type !== 0) {
            abort(404);
        }
        $ad->status = "Rejected";
        $ad->save();
        session()->flash('message-success', "Ad rejected!");
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " rejected Ad (AD ID#" . $ad->id . ").");
        return back();
    }

    public function update(Request $request, Ad $ad)
    {
        if (current_user()->type !== 0) {
            if (!current_user()->isPremium() && $ad->user_id !== current_user()->id){
                abort(404);
            }
        }

        $request->validate([
            "title" => "nullable|string|max:255",
            "size" => "required|string",
            "url" => "required|string",
            "description" => "nullable|string",
            "duration" => "required|string",
            // "status" => "required|string",
            "attachment" => "sometimes|nullable|file|image"
       ]);

        if (!$request->title && !$request->description) {
            if (!$request->attachment && !$ad->attachment) {
                session()->flash('message-danger', "Update Ad failed.");
                return back()->withErrors([
                    'attachment' => 'This field is required.',
                    'title' => 'This field is required.',
                    'description' => 'This field is required.',
                ]);
            }
        }

        $path = null;
        if ($request->attachment) {
            $path = $request->attachment->store('public/ad-attachments');
            $prefix = 'public/';
            if (substr($path, 0, strlen($prefix)) == $prefix) {
                $path = substr($path, strlen($prefix));
            }
        }

        if ($path) {
            if ($ad->attachment) {
                Storage::delete('public/' . $ad->attachment);
            }
            $ad->attachment = $path;
        }

        $size_array = explode("x", $request->size);
        $width = (int) $size_array[0];
        $height = (int) $size_array[1];
        $price = 0;
        switch($request->duration) {
            case "Week":
                $price = 897.12;
                break;
            case "Month":
                $price = 3588.48;
                break;
            case "Year":
                $price = 43061.76;
                break;
            default:
                break;
        }

        $ad->title = $request->title;
        $ad->size = $request->size;
        $ad->width = $width;
        $ad->height = $height;
        $ad->url = $request->url;
        $ad->description = $request->description;
        $ad->duration = $request->duration;
        $ad->price = $price;
        // $ad->status = $request->status;
        // $ad->status = $request->status;
        $ad->save();

        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " updated Ad (AD ID#" . $ad->id . ").");
        session()->flash('message-success', "Ad updated!");

        return redirect('admin/ads');
    }

    public function deletePhoto(Request $request, Ad $ad)
    {
        if (!$ad->title && !$ad->description) {
            session()->flash('message-danger', "Remove Ad photo failed.");
            return back()->withErrors([
                'attachment' => 'This field is required.',
                'title' => 'This field is required.',
                'description' => 'This field is required.',
            ]);
        }
        if (current_user()->type !== 0) {
            if (!current_user()->isPremium() && $ad->user_id !== current_user()->id){
                abort(404);
            }
        }
        if ($ad->attachment) {
            Storage::delete('public/' . $ad->attachment);
        }
        $ad->attachment = null;
        $ad->save();

        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " deleted Ad photo (AD ID#" . $ad->id . ").");
        session()->flash('message-success', "Ad photo removed!");
        return response()->json([], 200);
    }

    public function destroy(Request $request, Ad $ad)
    {
        if (current_user()->type !== 0) {
            if (!current_user()->isPremium() && $ad->user_id !== current_user()->id){
                abort(404);
            }
        }
        if ($ad->attachment) {
            Storage::delete('public/' . $ad->attachment);
        }
        $ad->delete();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " deleted Ad (AD ID#" . $ad->id . ").");
        return redirect('admin/ads');
    }
}
