<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;
use App\Gym;

class LocationsController extends BaseController
{
    public function index(Request $request)
    {
        $city_selected = null;
        $gyms = [];
        $cities = Gym::select('city')->orderBy('city', 'asc')->distinct()->get();
        if ($request->city) {
            $city_selected = $request->city;
            $gyms = Gym::where('city', $city_selected)->get();
        }
        return view('admin.locations.index', compact(
            'city_selected',
            'gyms',
            'cities'
        ));
    }
}
