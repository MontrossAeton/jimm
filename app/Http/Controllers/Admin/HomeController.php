<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\BaseController;

use App\Gym;
use App\User;
use App\Audit;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function index()
    {
        switch (auth()->user()->type) {
            case 0:
                $logs = Audit::latest()->paginate(30);
                break;
            case 1:
            case 3:
            case 4:
                $logs = auth()->user()->audits()->latest()->paginate(30);
                break;
            default:
                break;
        }
        $users_count = User::count();
        return view('admin.home', compact('users_count', 'logs'));
    }

    public function map()
    {
        $gyms = Gym::all();
        return view('admin.maps', compact('gyms'));
    }
}
