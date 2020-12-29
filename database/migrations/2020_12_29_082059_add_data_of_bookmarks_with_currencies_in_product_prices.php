<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Bookmark;
use App\Currency;
use App\ProductPrice;


class AddDataOfBookmarksWithCurrenciesInProductPrices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
  */
  public function up()
  {
      $bookmarks=Bookmark::with('product_prices')->get();

      
      $currencies=Currency::all();
       

  
      foreach($bookmarks as $bookmark){
          foreach($currencies as $currency){
            //  $price= DB::statement("select * from product_prices where product_id=$book->id and currency_id=$currency->id and product_type='books';");
          
            $price= ProductPrice::where('product_id',$bookmark->id)->where('currency_id',$currency->id)->where('product_type','bookmark')->first();
              if($price==null) {
                  
                      DB::statement("insert into `product_prices` (product_id,currency_id,product_type,price) VALUES ($bookmark->id, $currency->id,'bookmark',0);");
                  
          
              }
          }
      }
      
  }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_prices', function (Blueprint $table) {
            //
        });
    }
}
