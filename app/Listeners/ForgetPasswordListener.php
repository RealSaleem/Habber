<?php

namespace App\Listeners;

use App\Events\ForgetPasswordEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ForgetPasswordListener
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
     * @param  ForgetPasswordEvent  $event
     * @return void
     */
    public function handle(ForgetPasswordEvent $event)
    {
        //
    }
}
