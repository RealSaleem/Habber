<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSquareBannerColumnToBooksClubs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    if(!Schema::hasColumn('book_clubs','square_banner')) {
        Schema::table('book_clubs', function (Blueprint $table) {
            $table->string('square_banner')->after('banner_image');
        
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
        Schema::table('books_clubs', function (Blueprint $table) {
            //
        });
    }
}
