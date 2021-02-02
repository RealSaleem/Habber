<?php

namespace App\Listeners;

use App\Events\SendNotificationEvent;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use App\User;
use App\GuestUser;

class SendNotificationListener implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
     * @param  SendNotificationEvent  $event
     * @return void
     */
    public function handle(SendNotificationEvent $event)
    {
                       if($event->data['option']==1){
                        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/Firebase.json');
                        $firebase = (new Factory)
                        ->withServiceAccount($serviceAccount)
                        ->withDatabaseUri('https://hebber-72e2b.firebaseio.com/')
                        ->create();
                
                        $database   =   $firebase->getDatabase();
                        $notif = array(
                            'body'  =>  $event->data['description'],
                            'title' => $event->data['title']
                           );
                         
                               
                             
                           
                        for($i=0;$i<count($event->data['users']);$i++){
                            if($event->data['users'][$i]==0){
                                $user=GuestUser::all();
                             
                                for($i=0;$i<count($user);$i++){
                                 $createPost    =   $database 
                                 ->getReference('/User/'.$user[$i]['id'].'/Notification/')
                                 ->set([
                                     'to' =>  $user[$i]['id'],
                                     'body'  =>  $event->data['description'],
                                     'title' => $event->data['title'],
                                     'read' => 'false'
                         
                                 ]);   
                                          $user1=GuestUser::findOrFail($user[$i]['id']);
                                          
                                           $to= $user1->token;
                                           
                                           $this->sendNotif($to,$notif);
                            }}
                          else{  
                        $createPost    =   $database
                        ->getReference('/User/'.$event->data['users'][$i].'/Notification/')
                        ->set([
                            'to' =>  $event->data['users'][$i],
                            'body'  =>  $event->data['description'],
                            'title' => $event->data['title'],
                            'read' => 'false'
                
                        ]);   
                                 $user=User::findOrFail($event->data['users'][$i]);
                                 
                                  $to= $user->firebase_token;
                                  
                                  $this->sendNotif($to,$notif);


                     } }}
                     else if($event->data['option']==0){
                        $user=User::role(['user','publisher'])->where('status',1)->where('joining_request',0)->where('notification',1)->get();
                            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/Firebase.json');
                            $firebase = (new Factory)
                            ->withServiceAccount($serviceAccount)
                            ->withDatabaseUri('https://hebber-72e2b.firebaseio.com/')
                            ->create();
                    
                            $database   =   $firebase->getDatabase();
                            $notif = array(
                                'body'  =>  $event->data['description'],
                                'title' => $event->data['title']
                               );
                               $user=GuestUser::all();
                               for($i=0;$i<count($user);$i++){
                                $createPost    =   $database
                                ->getReference('/User/'.$user[$i]['id'].'/Notification/')
                                ->set([
                                    'to' =>  $user[$i]['id'],
                                    'body'  =>  $event->data['description'],
                                    'title' => $event->data['title'],
                                    'read' => 'false'
                        
                                ]);   
                                         $user1=GuestUser::findOrFail($user[$i]['id']);
                                         
                                          $to= $user1->token;
                                          
                                          $this->sendNotif($to,$notif);
                           }

                            for($i=0;$i<$user->count();$i++){
                            $createPost    =   $database
                            ->getReference('/User/'.$user[$i]['id'].'/Notification/')
                            ->set([
                                'to' =>  $user[$i]['id'],
                                'body'  =>  $event->data['description'],
                                'title' => $event->data['title'],
                                'read' => 'false'
                    
                            ]);   
                                   
                                     $to= $user[$i]['firebase_token'];
                                    $this->sendNotif($to,$notif);
                     }
                    }
                }
                    
    
}
