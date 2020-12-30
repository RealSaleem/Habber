<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBookIdColumnToBookclubs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('book_clubs','book_id')) {
            Schema::table('book_clubs', function (Blueprint $table) {
                $table->integer('book_id')->after('arabic_name');
            
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
        Schema::table('book_clubs', function (Blueprint $table) {
            //
        });
    }
}
