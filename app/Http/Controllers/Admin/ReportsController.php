<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;
use App\Audit;
use App\User;
use App\Gym;
use App\Subscription;
use App\Services;
use App\Review;
use PDF;

class ReportsController extends BaseController {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reports.index');
    }

    public function userLogs()
    {
        switch (auth()->user()->type) {
            case 0:
                $logs = Audit::latest()->get();
                break;
            case 1:
            case 3:
            case 4:
                $logs = auth()->user()->audits()->latest()->get();
                break;
            default:
                break;
        }
        //return view('admin.reports.user-logs', compact('logs'));
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " generated User Activity Logs Report");
        $pdf = PDF::loadView('admin.reports.user-logs', compact('logs'));
        return $pdf->download('user-logs.pdf');
    }

    public function systemUsers()
    {
        $super_admins = User::withTrashed()->where('type', 0)->get();
        $gym_admins = User::withTrashed()->where('type', 1)->get();
        $staffs = User::withTrashed()->where('type', 3)->get();
        $contents = User::withTrashed()->where('type', 4)->get();

        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " generated System Users Report");
        $pdf = PDF::loadView('admin.reports.system-users', compact('super_admins', 'customers', 'gym_admins', 'staffs', 'contents'));
        return $pdf->download('system-users.pdf');
    }

	public function customers()
	{
		$users_per_year = User::selectRaw('count(id) user_count, year(created_at) year')->groupBy('year')->get();
        $customers = User::withTrashed()->where('type', 2)->get();

        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " generated Customers Report");
        $pdf = PDF::loadView('admin.reports.customers', compact('users_per_year', 'customers'));
        return $pdf->download('customers.pdf');
	}

	public function gymCompanies()
	{
        $gyms = Gym::with('user')->get();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " generated Gym Companies Report");
        $pdf = PDF::loadView('admin.reports.gym-companies', compact('gyms'));
        return $pdf->download('gym-companies.pdf');
	}

	public function subscriptions()
	{
        $subscriptions = Subscription::with('user')->get();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " generated Subscriptions Report");
        $pdf = PDF::loadView('admin.reports.subscriptions', compact('subscriptions'));
        return $pdf->download('subscriptions.pdf');
	}

	public function services()
	{
        $services = auth()->user()->gym->services;
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " generated Services Report");
        $pdf = PDF::loadView('admin.reports.services', compact('services'));
        return $pdf->download('services.pdf');
	}

	public function reservations()
	{
        $reservations = auth()->user()->gym->reservations()->latest()->get();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " generated Reservations Report");
        $pdf = PDF::loadView('admin.reports.reservations', compact('reservations'));
        return $pdf->download('reservations.pdf');
	}

	public function ratingsAndReviews()
	{
		$gym = auth()->user()->gym;
		$reviews = $gym->reviews()->with('user')->latest()->get();
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

        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " generated Ratings and Reviews Report");
		$pdf = PDF::loadView('admin.reports.ratings-and-reviews', compact(
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
		return $pdf->download('ratings-and-reviews.pdf');
	}
}
