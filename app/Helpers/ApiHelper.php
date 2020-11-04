<?php
namespace App\Helpers;
use App\Currency;

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
        // $symbols =  Currency::pluck('iso')->toArray();
        $symbols = 'EUR,USD,GBP,BHD,OMR,QAR,SAR,AED';
       
        // initialize CURL:
        $ch = curl_init('https://data.fixer.io/api/'.$endpoint.'?access_key='.$access_key.'&base='.$base.'&symbols='.$symbols.'');   
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
}