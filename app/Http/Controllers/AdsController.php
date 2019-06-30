<?php

namespace App\Http\Controllers;

use App\Ad;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required_without_all:description,attachment|string|max:255",
            "size" => "required|string",
            "url" => "required|string",
            "description" => "required_without_all:title,attachment|string",
            "duration" => "required|string",
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
            "user_id" => auth()->user()->id,
            "title" => $request->title,
            "size" => $request->size,
            "height" => $height,
            "width" => $width,
            "url" => $request->url,
            "description" => $request->description,
            "status" => "Pending",
            "attachment" => $path,
            "duration" => $request->duration,
            "price" => $price,
        ]);
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " requested for Ad space (AD ID#" . $ad->id . ")");
        session()->flash('message-success', 'Request for Ad Space submitted.');

        return back();
    }

    public function show(Ad $ad)
    {
        //
    }

    public function edit(Ad $ad)
    {
        //
    }

    public function update(Request $request, Ad $ad)
    {
        //
    }

    public function destroy(Ad $ad)
    {
        //
    }
}
