<?php

namespace App\Jobs;

use App\Events\SendNotificationEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use App\User;
use App\GuestUser;
use App\Log;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data= $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */

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


    public function handle()
    { 
        if($this->data['option']==1){
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/Firebase.json');
            $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://hebber-72e2b.firebaseio.com/')
            ->create();
    
            $database   =   $firebase->getDatabase();
            $notif = array(
                'body'  =>  $this->data['description'],
                'title' => $this->data['title']
               );
             
                   
                 
               
            for($i=0;$i<count($this->data['users']);$i++){
                if($this->data['users'][$i]==0){
                    $user=GuestUser::all();
                    $log=new log();
                    $log->user_id='Guest User';
                    $log->description=$this->data['description'];
                    $log->title=$this->data['title'];
                    $log->save();
                    for($i=0;$i<count($user);$i++){
                     $createPost    =   $database 
                     ->getReference('/User/'.$user[$i]['id'].'/Notification/')
                     ->set([
                         'to' =>  $user[$i]['id'],
                         'body'  =>  $this->data['description'],
                         'title' => $this->data['title'],
                         'read' => 'false'
                        

                     ]); 

                              $user1=GuestUser::findOrFail($user[$i]['id']);
                              
                               $to= $user1->token;
                               
                               $this->sendNotif($to,$notif);
                }}
              else{  
            $createPost    =   $database
            ->getReference('/User/'.$this->data['users'][$i].'/Notification/')
            ->set([
                'to' =>  $this->data['users'][$i],
                'body'  =>  $this->data['description'],
                'title' => $this->data['title'],
                'read' => 'false'
    
            ]);   
            //$log = Log::create(['to' => $this->data['users'][$i]])(['body' =>$this->data['description']])(['body' =>$this->data['title']]) ;
          
            $log=new log();
            $u=User::findOrFail($this->data['users'][$i]);
            $log->user_id=$u->first_name;
            $log->description=$this->data['description'];
            $log->title=$this->data['title'];
            $log->save();

                     $user=User::findOrFail($this->data['users'][$i]);
                     
                      $to= $user->firebase_token;
                      
                      $this->sendNotif($to,$notif);


         } }}
         else if($this->data['option']==0){
             $tkn=array();
            $user=User::role(['user','publisher'])->where('status',1)->where('joining_request',0)->where('notification',1)->get();
                $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/Firebase.json');
                $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->withDatabaseUri('https://hebber-72e2b.firebaseio.com/')
                ->create();
        
                $database   =   $firebase->getDatabase();
                $notif = array(
                    'body'  =>  $this->data['description'],
                    'title' => $this->data['title']
                   );
                   $user=GuestUser::all();
                   for($i=0;$i<count($user);$i++){
                    $createPost    =   $database
                    ->getReference('/User/'.$user[$i]['id'].'/Notification/')
                    ->set([
                        'to' =>  $user[$i]['id'],
                        'body'  =>  $this->data['description'],
                        'title' => $this->data['title'],
                        'read' => 'false'
            
                    ]);   

                             $user1=GuestUser::findOrFail($user[$i]['id']);
                             
                              $to= $user1->token;
                              array_push($tkn,$to);
                            //  $this->sendNotif($to,$notif);
               }
               $log=new log();
               $log->user_id='To All Users';
               $log->description=$this->data['description'];
               $log->title=$this->data['title'];
               $log->save();
                for($i=0;$i<$user->count();$i++){
                $createPost    =   $database
                ->getReference('/User/'.$user[$i]['id'].'/Notification/')
                ->set([
                    'to' =>  $user[$i]['id'],
                    'body'  =>  $this->data['description'],
                    'title' => $this->data['title'],
                    'read' => 'false'
        
                ]);   
                       
                         $to= $user[$i]['firebase_token'];
                         array_push($tkn,$to);
                       // $this->sendNotif($to,$notif);
         }              
                        $token=array_unique($tkn);
                        foreach($token as $t) {
                            $this->sendNotif($t,$notif);
                        }
                    
       
        }
    }
}