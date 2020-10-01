<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserRegisteredEvent;
use App\EmailTemplate;
class UserRegisteredListener
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
    public function handle(UserRegisteredEvent $event)
    {
        $email_template = EmailTemplate::where('key','user_reg')->first();
        $find = array (
            'mName',
            'mEmail',
        );
        $replace = array(
            ucfirst($event->name),
            $event->email,
        );
        $body = $email_template->content;
    
        $EmailContent = str_replace($find, $replace, $body);
        $this->email = $event->email;
        $this->subject = $email_template->subject;
        \Mail::send("email_template.welcoming_aboard",['html' => $EmailContent], function ($message ) {
            $email_to =$this->email;
            $subject = $this->subject;
            $message->to($email_to);
            $message->subject($subject);
        });
    }
}
