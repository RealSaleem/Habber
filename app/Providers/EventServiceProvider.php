<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        'App\Events\UserRegisteredEvent' => [
            'App\Listeners\UserRegisteredListener',
        ],
        'App\Events\ForgetPasswordEvent' => [
            'App\Listeners\ForgetPasswordListener',
        ],
        'App\Events\SendNotificationEvent' => [
            'App\Listeners\SendNotificationListener',
        ],
        'App\Events\OrderStatusChangedEvent' => [
            'App\Listeners\SendOrderNotificationListener',
        ],
        'App\Events\OrderCancelledEvent' => [
            'App\Listeners\SendOrderCancellationNotificationListener',
        ],
        'App\Events\ForgotPasswordEvent' => [
            'App\Listeners\SendForgotPasswordEmailListener',
        ],
        'App\Events\OrderSuccessEvent' => [
            'App\Listeners\SendOrderSuccessEmailListener',
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
