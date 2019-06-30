<?php

namespace App\Http\Controllers;

use App\Gym;
use Illuminate\Http\Request;

class MapsController extends Controller
{
    public function index()
    {
        return view('maps');
    }

    public function getLocations()
    {
        $locations = [];
        $gyms = Gym::with('user')->get();
        foreach ($gyms as $gym) {
            if ($gym->user->isPremium()) {
                $locations[] = $gym;
            }
        }
        return response()->json($locations);
    }

    public function search(Request $request)
    {
        $q = $request->search;
        $gyms = Gym::where('name', 'like', '%'.$q.'%')->with('user')->limit(10)->get();

        $locations = [];
        foreach ($gyms as $gym) {
            if ($gym->user->isPremium()) {
                $locations[] = $gym;
            }
        }
        return response()->json($locations);
    }
}
