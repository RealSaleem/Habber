<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Book;
use App\Currency;
use App\ProductPrice;

class AddDataOfBooksWithDifferentCurrenciesInBooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $books=Book::all();
        
        $currencies=Currency::all();

    
        foreach($books as $book){
            foreach($currencies as $currency){
              //  $price= DB::statement("select * from product_prices where product_id=$book->id and currency_id=$currency->id and product_type='books';");
                
              $price= ProductPrice::where('product_id',$book->id)->where('currency_id',$currency->id)->where('product_type','book')->first();
                if($price==null) {
                    
                        DB::statement("insert into `product_prices` (product_id,currency_id,product_type,price) VALUES ($book->id, $currency->id,'book',0);");
                    

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
