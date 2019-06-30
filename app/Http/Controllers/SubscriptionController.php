<?php

namespace App\Http\Controllers;

use App\Subscription;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SubscriptionController extends Controller
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
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "type" => 'required|in:monthly,year_1'
        ]);

        $price = 0;
        switch($request->type) {
        case "monthly":
            $price = 160.00;
            break;
        case "year_1":
            $price = 1920.00;
            break;
        default:
            break;
        }

        $subscription = Subscription::create([
            "user_id" => auth()->id(),
            "status" => "Pending",
            "type" => $request->type,
            "price" => $price,
        ]);

        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " requested for a Subscription (SUBSCRIPTION ID#" . $subscription->id . ")");

        session()->flash('message-success', "Subscription applied! Waiting for admin's approval.");

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
