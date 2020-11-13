<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDetailsColumnInBusinesses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('businesses','details') && Schema::hasColumn('businesses','business_type') )
        Schema::table('businesses', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->string('business_type')->nullable()->change();
            $table->longText('details')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('businesses', function (Blueprint $table) {
            //
        });
    }
}
