<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Reservation;
use Carbon\Carbon;

class ReservationsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (current_user()->type === 1) {
            $reservations = current_user()->gym->reservations()->paginate(10);
        } else {
            $reservations = Reservation::where('status', 'Pending')->get();
        }
        return view('admin.reservations.index', compact('reservations'));
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
        //
    }

    public function approve(Request $request, Reservation $reservation)
    {
        $reservation->status = "Approved";
        $reservation->confirmed_at = Carbon::now();
        $reservation->save();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " approved Reservation (RESERVATION ID#" . $reservation->id . ")");
        session()->flash('message-info', "Reservation for " . $reservation->user->name . " was approved.");

        return back();
    }

    public function reject(Request $request, Reservation $reservation)
    {
        $reservation->status = "Rejected";
        $reservation->confirmed_at = Carbon::now();
        $reservation->save();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " rejected Reservation (RESERVATION ID#" . $reservation->id . ")");
        session()->flash('message-info', "Reservation for " . $reservation->user->name . " was rejected.");

        return back();
    }
}
