<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use Carbon\Carbon;
use App\Post;
use App\Ad;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->limit(9)->get();
        $datenow = (new \DateTime())->format('Y-m-d');
        $ads = Ad::latest()->where('status', 'Approved')->where('expiration_date', '>=', $datenow)->get();
        return view('layouts.welcome', compact('posts', 'ads'));
    }

    public function assessment()
    {
        return view('assessment');
    }

    public function profile()
    {
        $user = auth()->user();
        $subscription = $user->subscription;
        $user_is_premium = false;
        $subscription_is_pending = false;

        if ($subscription) {
            if ($user->isPremium()) {
                $user_is_premium = true;
            } else if ($subscription->status === "Pending") {
                $subscription_is_pending = true;
            }
        }
        return view('profile', compact('user', 'subscription', 'user_is_premium', 'subscription_is_pending'));
    }
}
