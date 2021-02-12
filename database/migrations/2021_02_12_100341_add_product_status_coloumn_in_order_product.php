<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductStatusColoumnInOrderProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('order_status','product_status')) {
            DB::statement("ALTER TABLE `order_product` ADD `product_status` ENUM('Not Ready','Ready') NOT NULL DEFAULT 'Not Ready' AFTER `quantity`;");
        }
    }

      /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_product', function (Blueprint $table) {
            //
        });
    }
}
