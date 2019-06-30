<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Service;

class ServicesController extends BaseController
{
    public function index()
    {
        return view('admin.services.index', [
            'services' => auth()->user()->gym->services
        ]);
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "description" => "required|string",
            "rate" => "string|max:255",
            "image" => "nullable|file|image"
        ]);

        $path = null;
        if ($request->image) {
            $path = $request->image->store('public/service-attachments');
            $prefix = 'public/';
            if (substr($path, 0, strlen($prefix)) == $prefix) {
                $path = substr($path, strlen($prefix));
            }
        }
        $service = new Service;
        $service->name = trim($request->name);
        $service->description = trim($request->description);
        $service->gym_id = $request->gym_id;
        $service->rate = $request->rate;
        $service->status = 1;
        $service->image = $path;
        $service->save();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " created a Service (SERVICE ID#" . $service->id . ")");
        session()->flash('message-success', "Service created!");

        return redirect('admin/services');
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request, Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "description" => "required|string",
            "image" => "nullable|file|image"
        ]);

        $path = null;
        if ($request->image) {
            if ($service->image) {
                Storage::delete('public/' . $service->image);
            }
            $path = $request->image->store('public/service-attachments');
            $prefix = 'public/';
            if (substr($path, 0, strlen($prefix)) == $prefix) {
                $path = substr($path, strlen($prefix));
            }
        }

        $service->name = trim($request->name);
        $service->description = trim($request->description);
        $service->image = $path;
        $service->save();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " updated Service (SERVICE ID#" . $service->id . ")");
        session()->flash('message-success', "Service updated!");

        return redirect('admin/profile');
    }

    public function destroy(Request $request, Service $service)
    {
        if ($service->image) {
            Storage::delete('public/' . $service->image);
        }
        $service = $service->delete();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " deleted Service (SERVICE ID#" . $service->id . ")");
        session()->flash('message-success', "Service deleted.");
        return redirect('admin/profile');
    }
}
