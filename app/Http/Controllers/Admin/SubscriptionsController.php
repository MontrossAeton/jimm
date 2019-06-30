<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Support\Facades\Auth;

use App\Subscription;
use Carbon\Carbon;

class SubscriptionsController extends BaseController
{
    public function index()
    {
        if(Auth::user()->type == 0) {
            $subscriptions = Subscription::orderBy('created_at', 'desc')->get();
        } else {
           $subscriptions = Auth::user()->subscriptions()->orderBy('created_at', 'desc')->get();
        }
        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function approve(Request $request, Subscription $subscription)
    {
        $date_expired = Carbon::now();

        switch ($subscription->type) {
            case "monthly":
                $date_expired = $date_expired->addMonth();
                break;
            case "year_1":
                $date_expired = $date_expired->addYear();
                break;
            case "year_2":
                $date_expired = $date_expired->addYears(2);
                break;
            case "year_3":
                $date_expired = $date_expired->addYears(3);
                break;
            case "year_4":
                $date_expired = $date_expired->addYears(4);
                break;
            case "year_5":
                $date_expired = $date_expired->addYears(5);
                break;
        }

        $subscription->status = "Approved";
        $subscription->date_added = Carbon::now();
        $subscription->date_expired = $date_expired;
        $subscription->save();

        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " approved Subscription (SUBSCRIPTION ID#" . $subscription->id . ")");

        session()->flash('message-info', "Subscription for " . $subscription->user->name . " was approved.");

        return back();
    }

    public function reject(Request $request, Subscription $subscription)
    {
        $subscription->status = "Rejected";
        $subscription->save();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " rejected Subscription (SUBSCRIPTION ID#" . $subscription->id . ")");
        session()->flash('message-info', "Subscription for " . $subscription->user->name . " was rejected.");

        return back();
    }

    public function premiumAdsSubscription(Request $request)
    {
        $request->validate([
            "type" => 'required|in:monthly,year_1'
        ]);

        $price = 0;
        switch($request->type) {
        case "monthly":
            $price = 801.30;
            break;
        case "year_1":
            $price = 9615.60;
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

        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " requested for a Premium Subscription (SUBSCRIPTION ID#" . $subscription->id . ")");

        session()->flash('message-success', "Subscription applied! Waiting for admin's approval.");

        return back();
    }

}
