<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Gym;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, Gym $gym)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'description' => 'required|string',
        ]);

        $review = $gym->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'description' => $request->description,
        ]);

        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " submitted a review for a Gym (REVIEW ID#" . $review->id . ")");

        session()->flash('message-success', 'Review posted!');
        return back();
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
    public function update(Request $request, Gym $gym, Review $review)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'description' => 'required|string',
        ]);

        $review->rating = $request->rating;
        $review->description = $request->description;
        $review->save();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " updated review for a Gym (REVIEW ID#" . $review->id . ")");

        session()->flash('message-success', 'Review updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gym $gym, Review $review)
    {
        $review->delete();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " deleted review for a Gym (REVIEW ID#" . $review->id . ")");
        session()->flash('message-success', 'Review deleted!');
        return back();
    }
}
