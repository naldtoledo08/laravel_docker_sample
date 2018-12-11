<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \OwenIt\Auditing\Events\Audited::class => [
            \App\Listeners\AuditedListener::class
        ],
        'App\Events\TimesheetEvent' => [
            'App\Listeners\TimesheetEventListener',
        ],
        'App\Events\AppLogout' => [
            'App\Listeners\AppLogout',
            'App\Listeners\TimesheetEventListener',
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
