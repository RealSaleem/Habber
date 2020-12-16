<?php
namespace App\Helpers;
use App\Currency;
use App\User;
use Session;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class ApiHelper {

    public static function apiResult($status,$code,$message,$data = null) {
        if($data) {
            return response()->json(['data' => $data,'status' => $status, 'code' => $code, 'message' => $message ]);
        }
        else {
            return response()->json(['data' =>[],'status' => $status, 'code' => $code, 'message' => $message ]);
        }
       
    }

    public static function currencyConverter() {
        $endpoint = 'latest';
        $access_key =  env("FIXER_API_KEY");

        $base = 'KWD';
        // $amount = $price;
        $iso =  Currency::pluck('iso')->toArray();
        $symbols = implode(",",$iso);
       
        // initialize CURL:
        $ch = curl_init('http://data.fixer.io/api/'.$endpoint.'?access_key='.$access_key.'&base='.$base.'&symbols='.$symbols.'');   
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // get the JSON data:
        $json = curl_exec($ch);
        dd($json);
        curl_close($ch);

        // Decode JSON response:
        $conversionResult = json_decode($json, true);

        // access the conversion result
        echo $conversionResult['result'];
    }
    public static function getData(){
        $users =  User::role(['user','publisher'])->where('status',1)->where('joining_request',0)->get();

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
                    array_push($value,$snapshot->getValue());
                        
                    }
                    Session::put('notification',$value);
    }

}