<?php

namespace App\Listeners;

use App\Audit;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEventSubscriber
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handleUserLogin($event)
    {
        Audit::create([
            "user_id" => $event->user->id,
            "description" => "(USER ID#" . $event->user->id . ") " . $event->user->name . " logged in successfully."
        ]);
    }

    public function handleUserLogout($event)
    {
        Audit::create([
            "user_id" => $event->user->id,
            "description" => "(USER ID#" . $event->user->id . ") " . $event->user->name . " logged out successfully."
        ]);
    }

    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@handleUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscriber@handleUserLogout'
        );
    }
}
