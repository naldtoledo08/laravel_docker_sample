<?php

namespace App\Listeners;

use App\Events\Timesheetevent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Pusher\Laravel\Facades\Pusher;

class TimesheetEventListener
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
     * @param  Timesheetevent  $event
     * @return void
     */
    public function handle(Timesheetevent $event)
    {   
        $action = (isset($event->timesheet->time_out) && $event->timesheet->time_out) ? 'logout' : 'login';

        $user = $event->user;

        $data = [
            'user_id' => $user->id,
            'user_name' => $user->full_name,
            'user_slug' => $user->slug,
            'time_in' => $event->timesheet->time_in,
            'time_in_display' => display_time($event->timesheet->time_in),
        ];

        Pusher::trigger('timesheet-monitoring', $action, ['timesheet' => $data]);
    }
}
