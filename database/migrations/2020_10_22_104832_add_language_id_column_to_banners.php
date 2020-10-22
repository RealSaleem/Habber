<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLanguageIdColumnToBanners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('banners','language_id')){
            Schema::table('banners', function (Blueprint $table) {
                //
                $table->string('language_id')->nullable()->after('description');

                
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
        Schema::table('banners', function (Blueprint $table) {
            //
        });
    }
}
