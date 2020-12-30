<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumnToBookClubs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('book_clubs','status')) {
            Schema::table('book_clubs', function (Blueprint $table) {
                $table->boolean('status')->after('featured')->default(0);
            
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
