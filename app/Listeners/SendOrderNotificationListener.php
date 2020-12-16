<?php

namespace App\Listeners;
use App\Events\OrderStatusChangedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use App\User;

class SendOrderNotificationListener
{
    public function sendNotif($to,$notif){ 
        $apiKey=env('FIREBASE_API_KEY');
        $ch = curl_init();
        
            $url=env('FIREBASE_URL');
            $fields = json_encode(array('to'=>$to, 'notification'=>$notif));
    
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

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderStatusChangedEvent $event)
    {

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/Firebase.json');
                        $firebase = (new Factory)
                        ->withServiceAccount($serviceAccount)
                        ->withDatabaseUri('https://hebber-72e2b.firebaseio.com/')
                        ->create();
                
                        $database   =   $firebase->getDatabase();
                        if($event->order['status']==0){
                             $description="Confirmed";
                        }
                        else if($event->order['status']==1){
                            $description="Shipped";
                        }
                        else if($event->order['status']==2){
                            $description="Delivered";
                        }
                        $notif = array(
                            'body'  =>  'Your order has been '.$description,
                           );
                    
                        $createPost    =   $database
                        ->getReference('/User/'.$event->order['user_id'].'/OrderNotification/')
                        ->set([
                            'to' =>  $event->order['user_id'],
                            'body'  =>  $description,
                            'read' => 'false'
                
                        ]);   
                                 $user=User::findOrFail($event->order['user_id']);
                                 
                                  $to= $user->firebase_token;
                                  
                                  $this->sendNotif($to,$notif);


                     
    }
}
