<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\OrderSuccessEvent;
use Mail;
use App\User;
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
       $user=User::where('id',$order['user_id'])->first();
       $email=$user['email'];
        Mail::send(
            'orders.success_email',['email'=> $email, 'order'=>$order],
            function($message) use ($email){
                $message->to($email);
                $message->subject("Order Placed Successfully");
            }
        );
    }
}
