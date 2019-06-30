<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\BaseController;

use Illuminate\Http\Request;

class ProfileController extends BaseController
{
    public function index()
    {
        $user = current_user();
        $subscription = $user->subscription;
        $user_is_premium = false;
        $subscription_is_pending = false;

        if ($subscription) {
            if ($user->isPremium()) {
                $user_is_premium = true;
            } else if ($subscription->status === "Pending"){
                $subscription_is_pending = true;
            }
        }

        return view('admin.profile', [
            'user' => $user,
            'gym' => $user->gym,
            'user_is_premium' => $user_is_premium,
            'subscription_is_pending' => $subscription_is_pending,
        ]);
    }
}
