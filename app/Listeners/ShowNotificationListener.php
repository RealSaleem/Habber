<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Events\ShowNotificationEvent;

class ShowNotificationListener implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create the event listener.
     *
     * @return void
     */
    
    public function handle(ShowNotificationEvent $event)
    {
        $users =  User::role(['user','publisher'])->where('status',1)->where('joining_request',0)->where('notification',1)->get();

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/Firebase.json');
                        $firebase = (new Factory)
                        ->withServiceAccount($serviceAccount)
                        ->withDatabaseUri('https://hebber-72e2b.firebaseio.com/')
                        ->create();
                        $database   =   $firebase->getDatabase();
                        $value= array();
                   foreach($users as $user){
                        
                     $getData    =   $database
                        ->getReference('/User/'.$user->id.'/OrderNotification/');
                        $snapshot = $getData->getSnapshot();
                        if($snapshot->getValue()!=null){
                     array_push($value,$snapshot->getValue());}
                         
                     }
                    
                     Session::put('notification',$value);
    }
}
