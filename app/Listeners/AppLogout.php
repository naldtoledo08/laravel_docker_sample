<?php

namespace App\Listeners;

use App\Events\AppLogout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AppLogout
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
     * @param  AppLogout  $event
     * @return void
     */
    public function handle(AppLogout $event)
    {
        //
    }
}
