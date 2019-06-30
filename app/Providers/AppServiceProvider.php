<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('user.partials.my-subscriptions-modal', function ($view) {
            if (auth()->check()) {
                $view->with('my_subscriptions', auth()->user()->subscriptions()->latest()->get());
            }
        });

        view()->composer('user.partials.my-reservations-modal', function ($view) {
            if (auth()->check()) {
                $view->with('my_reservations', auth()->user()->reservations()->latest()->get());
            }
        });
    }
}
