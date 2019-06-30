<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UsersController extends BaseController
{
    public function index()
    {
        $super_admins = User::withTrashed()->where('type', 0)->get();
        $gym_admins = User::withTrashed()->where('type', 1)->get();
        $customers = User::withTrashed()->where('type', 2)->get();
        $staffs = User::withTrashed()->where('type', 3)->get();
        $contents = User::withTrashed()->where('type', 4)->get();
        return view('admin.users.index', compact('super_admins', 'customers', 'gym_admins', 'staffs', 'contents'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'name' => "required|string|max:255|regex:/^[\pL\s\-\.\']+$/u", // allows letters, hyphens, dots, single apostrophe  and spaces
            "type" => "required|string",
            'password' => 'required|string|confirmed|min:6',
            "profile_picture" => "nullable|file|image"
        ]);

        $path = null;
        if ($request->profile_picture) {
            $path = $request->profile_picture->store('public/profile_pictures');
            $prefix = 'public/';
            if (substr($path, 0, strlen($prefix)) == $prefix) {
                $path = substr($path, strlen($prefix));
            }
        }

        $user = User::create([
            "email" => $request->email,
            "name" => $request->name,
            "type" => $request->type,
            "password" => bcrypt($request->password),
            "logo" => $path
        ]);
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " created new User (USER ID#" . $user->id . ")");
        session()->flash('message-success', "User created!");

        return redirect('admin/users');
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request, User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'name' => "required|string|max:255|regex:/^[\pL\s\-\.\']+$/u", // allows letters, hyphens, dots, single apostrophe  and spaces
        ]);

        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " updated User (USER ID#" . $user->id . ")");
        session()->flash('message-success', "User updated!");

        return redirect('admin/users');
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " deactivated User (USER ID#" . $user->id . ")");
        session()->flash('message-success', "User deactivated.");
        return redirect('admin/users');
    }

    public function restore(Request $request, $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " reactivated User (USER ID#" . $user->id . ")");
        session()->flash('message-success', "User reactivated.");
        return redirect('admin/users');
    }
}
