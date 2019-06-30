<?php

namespace App\Http\Controllers\Admin;

use App\Review;
use App\Gym;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;

class FeedbacksController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gym = null;
        if (auth()->user()->type === 1) {
            $gym = auth()->user()->gym;
            $reviews = $gym->reviews()->latest()->paginate(30);
        } else {
            $reviews = Review::latest("updated_at")->with([ 'user', 'gym' ])->paginate(30);
        }
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

        return view('admin.feedbacks.index', compact(
            'gym',
            'reviews_count',
            'gym_rating',
            'rate_1',
            'rate_2',
            'rate_3',
            'rate_4',
            'rate_5',
            'reviews'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " deleted review for a Gym (REVIEW ID#" . $review->id . ")");
        session()->flash('message-success', 'Review deleted!');
        return back();
    }
}
