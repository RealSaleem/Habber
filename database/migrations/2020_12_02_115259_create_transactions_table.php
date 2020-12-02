<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('code');
            $table->string('message');
            $table->string('resultcode');
            $table->string('amount');
            $table->string('paymenttoken');
            $table->string('paymentid');
            $table->string('paidOn');
            $table->string('orderreferencenumber');
            $table->string('variable1');
            $table->string('variable2');
            $table->string('variable3');
            $table->string('variable4');
            $table->string('variable5');
            $table->integer('method');
            $table->string('administrativecharge');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
