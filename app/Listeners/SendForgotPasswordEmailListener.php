<?php

namespace App\Listeners;

use App\Events\ForgotPasswordEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendForgotPasswordEmailListener
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
     * @param  ForgotPasswordEvent  $event
     * @return void
     */
    public function handle(ForgotPasswordEvent $event)
    {
        
        $email=$event->request;
       
        Mail::send(
            'auth.passwords.forgot',['email'=> $email['email'], 'token'=>$email['_token']],
            function($message) use ($email){
                $message->to($email['email']);
                $message->subject("reset your password.");
            }
        );
    }
}
