<?php

namespace App\Listeners;

use App\Events\OrderCancelledEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use App\User;

class SendOrderCancellationNotificationListener
{
    public function sendNotification($to,$notif){ 
        $apiKey=env('FIREBASE_API_KEY');
        $ch = curl_init();
        
            $url=env('FIREBASE_URL');
            $fields = json_encode(array('to'=>$to, 'notification'=>$notif, 'priority' => 'high'));
    
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($fields));
    
        $headers = array();
        $headers[] = 'Authorization: key ='.$apiKey;
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
        $result = curl_exec($ch);
        if(curl_error($ch)){
            echo 'ERROR:'.curl_error($ch);
        }
        curl_close($ch);
        }

    public function handle(OrderCancelledEvent $event)
    {   
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/Firebase.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://hebber-72e2b.firebaseio.com/')
        ->create();

        $database   =   $firebase->getDatabase();
        $notif = array(
            'body'  =>  'Your order has been Cancelled',
           );
    
        $createPost    =   $database
        ->getReference('/User/'.$event->order['user_id'].'/OrderNotification/')
        ->set([
            'to' =>  $event->order['user_id'],
            'body'  =>  'Your order has been Cancelled',
            'read' => 'false'

        ]);   
                 $user=User::findOrFail($event->order['user_id']);
                 
                  $to= $user->firebase_token;
                  
                  $this->sendNotification($to,$notif);


     
}
}

