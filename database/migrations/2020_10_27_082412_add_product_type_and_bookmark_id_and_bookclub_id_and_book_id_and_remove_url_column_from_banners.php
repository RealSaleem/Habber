<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductTypeAndBookmarkIdAndBookclubIdAndBookIdAndRemoveUrlColumnFromBanners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('banners','url')) {
            Schema::table('banners', function (Blueprint $table) {
                $table->dropColumn('url');
               
            });
        }
        if (!Schema::hasColumn('banners','product_type') && !Schema::hasColumn('banners','bookmark_id') && !Schema::hasColumn('banners','bookclub_id') && !Schema::hasColumn('banners','book_id')) {
            Schema::table('banners', function (Blueprint $table) {
                $table->string('product_type')->after('description');
                $table->integer('bookmark_id')->nullable()->after('product_type');
                $table->integer('bookclub_id')->nullable()->after('bookmark_id');
                $table->integer('book_id')->nullable()->after('bookclub_id');
            
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
