<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;

class UpdatePrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'price:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call fixer.io API and update currencies rate and product and bookmarks price';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currenciesArr = [];
        try {
            $client = new \GuzzleHttp\Client();
            $request = $client->get('https://data.fixer.io/api/latest?access_key='.env('FIXER_API_KEY').'&base=KWD&symbols=KWD,EUR,USD,GBP,BHD,OMR,QAR,SAR,AED,&format=1');
            $response = $request->getBody()->getContents();
            $responseObj = json_decode($response);
            if($responseObj->success == 1) {
                foreach($responseObj->rates as $iso => $rate) {
                    //update using ISO code
                    \App\Currency::where('iso', $iso)->update(['rate' => $rate]);
                }
                //update prices
                $currencies = \App\Currency::where('id','!=',1)->get();
                $products = \App\ProductPrice::where('currency_id', 1)->where('product_type','book')->get();
                
                foreach($products as $product) {
                    foreach($currencies as $currency) {
                        \App\ProductPrice::where('currency_id', $currency->id)->where('product_id', $product->product_id)->update(['price' => $product->price * $currency->rate]);
                    }
                }
                
                $products = \App\ProductPrice::where('currency_id', 1)->where('product_type','bookmark')->get();
                foreach($products as $product) {
                    foreach($currencies as $currency) {
                        \App\ProductPrice::where('currency_id', $currency->id)->where('product_id', $product->product_id)->update(['price' => $product->price * $currency->rate]);
                    }
                }
            } 
        } catch (Exception $ex) {
        }
        
    }
}
