<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArabicTitleAndArabicMakerNameAndArabicDescriptionColumnToBookmarks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('bookmarks','arabic_title') && !Schema::hasColumn('bookmarks','arabic_maker_name') && !Schema::hasColumn('bookmarks','arabic_description')) {
            Schema::table('bookmarks', function (Blueprint $table) {
                $table->string('arabic_title')->after('title');
                $table->string('arabic_maker_name')->after('maker_name');
                $table->longText('arabic_description')->after('description');
                
            
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
        Schema::table('bookmarks', function (Blueprint $table) {
            //
        });
    }
}
