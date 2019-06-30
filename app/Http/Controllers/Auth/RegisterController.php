<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

use App\Gym;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'g-recaptcha-response' => 'required|captcha', 
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => "required|string|max:255|regex:/^[\pL\s\-\.\']+$/u", // allows letters, hyphens, dots, single apostrophe  and spaces
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => trim($request->name),
            'email' => trim($request->email),
            'membership_type' => "Free",
            'type' => 2,
            'password' => Hash::make($request->password),
        ]);

        $this->audit->log($user, "(USER ID#" . $user->id . ") " . " registered account successfully.");
        session()->flash('message-success', 'Customer Account created!');
        return back();
    }

    public function registerAdmin(Request $request)
    {
        $request->validate([
            'name' => "required|string|max:255|regex:/^[\pL\s\-\.\']+$/u", // allows letters, hyphens, dots, single apostrophe  and spaces
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'gym_name' => "required|string|max:255",
            'street' => "required|string|max:255",
            'city' => "required|string|max:255",
            //'landmark' => "nullable|string|max:255",
            //'landline' => "required|string|max:255",
            //'mobile' => "nullable|string|max:255",
            //'website' => "nullable|string|max:255",
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180',
        ]);

        $gym = Gym::create([
            "name" => trim($request->gym_name),
            "street" => trim($request->street),
            "city" => trim($request->city),
            //"landmark" => trim($request->landmark),
            //"landline" => trim($request->landline),
            //"mobile" => trim($request->mobile),
            //"website" => trim($request->website),
            "lat" => (float) $request->latitude,
            "long" => (float) $request->longitude,
            "status" => 1,
        ]);
        if ($gym) {
            $user = User::create([
                'name' => trim($request->name),
                'email' => trim($request->email),
                'type' => 1,
                'gym_id' => $gym->id,
                'password' => Hash::make($request->password),
            ]);
            session()->flash('message-success', 'Gym admin created!');
            $this->audit->log($user, "(USER ID#" . $user->id . ") " . " registered account successfully.");
        }

        return back();
    }
}
