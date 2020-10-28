<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLanguageIdAndCurrencyIdColumnToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('users','language_id') && !Schema::hasColumn('users','currency_id'))
        Schema::table('users', function (Blueprint $table) {
            $table->integer('language_id')->nullable()->after('notes');
            $table->integer('currency_id')->nullable()->after('language_id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
