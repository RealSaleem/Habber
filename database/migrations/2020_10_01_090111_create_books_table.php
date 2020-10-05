<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author_name');
            $table->string('cover_type');
            $table->longText('description');
            $table->string('book_language');
            $table->double('price');
            $table->bigInteger('isbn')->unique();
            $table->integer('total_pages');
            $table->integer('quantity');
            $table->integer('business_id');
            $table->boolean('status')->default(false);
            $table->boolean('stock_status')->default(false);
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
