<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use View;
use App\User;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $count_pending_ads = count_pending('\App\Ad');
        $count_pending_subs = count_pending('\App\Subscription');
        $count_pending_reservations = count_pending('\App\Reservation');

        View::share ( 'count_pending_reservations', $count_pending_reservations );
        View::share ( 'count_pending_ads', $count_pending_ads );
        View::share ( 'count_pending_subs', $count_pending_subs );
    }
}
