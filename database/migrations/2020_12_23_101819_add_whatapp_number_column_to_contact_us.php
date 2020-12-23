<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWhatappNumberColumnToContactUs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('contact_us','whatapp_number')) {
            Schema::table('contact_us', function (Blueprint $table) {
                $table->integer('whatapp_number')->after('phone');
            
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
        Schema::table('contact_us', function (Blueprint $table) {
            //
        });
    }
}
