<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gym;

class GymsController extends Controller
{
    public function show(Gym $gym)
    {
        if (!$gym->user->isPremium()) {
            abort(404);
        }
        $user_can_review = true;
        $user_has_review = false;

        $reviews = $gym->reviews()->latest("updated_at")->get()->load('user');
        $my_review = null;
        $gym_rating = null;
        $rate_1 = $rate_2 = $rate_3 = $rate_4 = $rate_5 = null;

        if ($reviews_count = count($reviews)) {
            $ratings = $reviews->pluck('rating')->all();
            $rates = collect($ratings)->countBy()->all();
            $gym_rating = round(array_sum($ratings) / $reviews_count, 2);
            if (array_key_exists(1, $rates)) {
                $rate_1 = ($rates[1] / $reviews_count) * 100;
            }
            if (array_key_exists(2, $rates)) {
                $rate_2 = ($rates[2] / $reviews_count) * 100;
            }
            if (array_key_exists(3, $rates)) {
                $rate_3 = ($rates[3] / $reviews_count) * 100;
            }
            if (array_key_exists(4, $rates)) {
                $rate_4 = ($rates[4] / $reviews_count) * 100;
            }
            if (array_key_exists(5, $rates)) {
                $rate_5 = ($rates[5] / $reviews_count) * 100;
            }
        }

        if (!auth()->check()) {
            $user_can_review = false; 
        } else {
            if ($reviews->contains('user_id', auth()->id())) {
                $user_can_review = false;
                $user_has_review = true;
                $my_review = $reviews->where('user_id', auth()->id())->first();
            }
        }

        $gym_images = $gym->gym_images;
        return view('gyms.show', compact(
            'gym',
            'gym_images',
            'reviews_count',
            'gym_rating',
            'rate_1',
            'rate_2',
            'rate_3',
            'rate_4',
            'rate_5',
            'reviews',
            'my_review',
            'user_can_review',
            'user_has_review'
        ));
    }
}
