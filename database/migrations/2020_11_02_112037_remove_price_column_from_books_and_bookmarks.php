<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePriceColumnFromBooksAndBookmarks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('books','price')) {
            Schema::table('books', function (Blueprint $table) {
                $table->dropColumn('price');
            });
        }

        if(Schema::hasColumn('bookmarks','price')) {
            Schema::table('bookmarks', function (Blueprint $table) {
                $table->dropColumn('price');
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
        Schema::table('books', function (Blueprint $table) {
            //
        });
    }
}
