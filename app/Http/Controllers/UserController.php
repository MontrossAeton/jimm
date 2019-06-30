<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'name' => "required|string|max:255|regex:/^[\pL\s\-\.\']+$/u", // allows letters, hyphens, dots, single apostrophe  and spaces
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
        ]);
        auth()->user()->name = trim($request->name);
        auth()->user()->email = trim($request->email);
        auth()->user()->save();

        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " updated user details.");
        session()->flash('message-success', 'Updated user details successfully.');
        return redirect()->back();
    }

    public function changeProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|file|image'
        ]);
        if (auth()->user()->profile_picture) {
            Storage::delete('public/' . auth()->user()->profile_picture);
        }
        $path = null;
        if ($request->profile_picture) {
            $path = $request->profile_picture->store('public/profile_pictures');
            $prefix = 'public/';
            if (substr($path, 0, strlen($prefix)) == $prefix) {
                $path = substr($path, strlen($prefix));
            }
        }

        auth()->user()->profile_picture = $path;
        $wew = auth()->user()->save();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " changed profile picture.");
        session()->flash('message-success',  'Updated profile picture successfully.');
        return redirect()->back();
    }

    public function removeProfilePicture(Request $request)
    {
        if (auth()->user()->profile_picture) {
            Storage::delete('public/' . $user->profile_picture);
        }
        auth()->user()->profile_picture = null;
        auth()->user()->save();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " removed profile picture.");
        session()->flash('message-success', 'Deleted profile picture successfully.');
        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if (Hash::check($request->current_password, auth()->user()->password)) {
            auth()->user()->password = bcrypt($request->password);
            auth()->user()->save();
            $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " changed password.");
            session()->flash('message-success', 'Changed password successfully.');
            return redirect()->back();
        }
        session()->flash('message-danger', 'Change Password failed.');
        return redirect()->back();
    }
}
