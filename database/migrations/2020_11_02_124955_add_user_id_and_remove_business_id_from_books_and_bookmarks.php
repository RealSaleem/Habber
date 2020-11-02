<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdAndRemoveBusinessIdFromBooksAndBookmarks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('books','business_id') && !Schema::hasColumn('books','user_id')) {
            Schema::table('books', function (Blueprint $table) {
                $table->dropColumn('business_id');
                $table->integer('user_id')->after('quantity');
            });
        }

        if(Schema::hasColumn('bookmarks','business_id') && !Schema::hasColumn('bookmarks','user_id')) {
            Schema::table('bookmarks', function (Blueprint $table) {
                $table->dropColumn('business_id');
                $table->integer('user_id')->after('quantity');
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
