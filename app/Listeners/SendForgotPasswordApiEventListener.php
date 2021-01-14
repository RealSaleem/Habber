<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ForgotPasswordApiEvent;
use Mail;

class SendForgotPasswordApiEventListener
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
    public function handle(ForgotPasswordApiEvent $event)
    {
        $email=$event->request;
        $token=$event->token;
        
       
        Mail::send(
            'auth.passwords.forgotapi',['email'=> $email['email'], 'token'=>$token, 'url'=>$email['base_url']],
            function($message) use ($email){
                $message->to($email['email']);
                $message->subject("reset your password.");
            }
        );
    }
}
