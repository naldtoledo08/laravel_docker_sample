<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use OwenIt\Auditing\Events\Audited;
use Pusher\Laravel\Facades\Pusher;

class AuditedListener
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
    public function handle($event)
    {
        $audit = $event->audit->toArray();
        $audit['user_name'] = $event->audit->user->name;
        Pusher::trigger('audits', 'new-audit', ['audit' => $audit]);
    }
}
