<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Support\Facades\Auth;
use App\Gym;

use Illuminate\Http\Request;

class GymsController extends BaseController
{
    public function index()
    {
        $gyms = Gym::withTrashed()->get();
        return view('admin.gyms.index', compact('gyms'));
    }

    public function create()
    {
        $user = Auth::user();
        return view('admin.gyms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|string|max:255",
            "description" => "required|string",
        ]);

        Gym::create([
            "title" => $request->title,
            "description" => $request->description,
            "status" => true,
        ]);
        session()->flash('message-success', "Gym created!");

        return redirect('admin/gyms');
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request, Gym $gym)
    {
        return view('admin.gyms.edit', compact('Gym'));
    }

    public function update(Request $request, Gym $gym)
    {
        $request->validate([
            "name" => "required|string",
            "branch" => "nullable|string",
            "street" => "required|string",
            "city" => "required|string",
            "landline" => "nullable",
            "mobile" => "nullable",
            "operating_hours" => "nullable",
            "website" => "required|string",
            "lat" => "required|string",
            "long" => "required|string",
            "logo" => "nullable|file|image"
        ]);

        $path = null;
        if ($request->logo) {
            $path = $request->logo->store('public/gym-logos');
            $prefix = 'public/';
            if (substr($path, 0, strlen($prefix)) == $prefix) {
                $path = substr($path, strlen($prefix));
            }
        }

        $gym->name = $request->name;
        $gym->branch = $request->branch;
        $gym->street = $request->street;
        $gym->city = $request->city;
        $gym->landline = $request->landline;
        $gym->mobile = $request->mobile;
        $gym->operating_hours = $request->operating_hours;
        $gym->website = $request->website;
        $gym->long = $request->long;
        $gym->lat = $request->lat;
        $gym->logo = $path;
        $gym->save();
        session()->flash('message-success', "Gym updated!");

        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " updated Gym (GYM ID#" . $gym->id . ")");

        return redirect('admin/profile');
    }

    public function destroy(Request $request, Gym $gym)
    {
        $gym->user->delete();
        $gym->delete();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " deactivated Gym (GYM ID#" . $gym->id . ")");
        session()->flash('message-success', "Gym deactivated.");
        return redirect('admin/gyms');
    }

    public function restore(Request $request, $id)
    {
        $gym = Gym::onlyTrashed()->findOrFail($id);
        $gym->restore();
        $gym->user->restore();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " restored Gym (GYM ID#" . $gym->id . ")");
        session()->flash('message-success', "Gym restored.");
        return redirect('admin/gyms');
    }

    public function deleteGymLogo(Request $request, Gym $gym)
    {
        $gym->logo = null;
        $gym->save();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " removed Gym Logo (GYM ID#" . $gym->id . ")");
        session()->flash('message-success', "Gym logo removed");
        return redirect('admin/profile');
    }
}
