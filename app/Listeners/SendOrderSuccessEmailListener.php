<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\OrderSuccessEvent;
class SendOrderSuccessEmailListener
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
    public function handle(OrderSuccessEvent $event)
    {
       $order=$event->order;
        Mail::send(
            'order.sucess_email',['email'=> $email['email'], 'token'=>$email['_token']],
            function($message) use ($order){
                $message->to($email['email']);
                $message->subject("reset your password.");
            }
        );
    }
}
