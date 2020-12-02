<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentstatusColumnAndPaymentmessageColumnInOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('orders', 'payment_status')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->text('payment_status')->after('status');
            });
        }

        if(!Schema::hasColumn('orders', 'payment_message')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->text('payment_message')->after('payment_status');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            Schema::dropIfExists('payment_status');
            Schema::dropIfExists('payment_message');
        });
    }
}
