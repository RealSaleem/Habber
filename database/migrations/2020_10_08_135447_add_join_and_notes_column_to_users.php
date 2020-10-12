<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJoinAndNotesColumnToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('users','joining_request') && !Schema::hasColumn('users','notes')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('last_name')->nullable()->change();
                $table->string('password')->nullable()->change();
                $table->boolean('joining_request')->default(0)->after('status');
                $table->string('notes')->nullable()->after('joining_request');
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
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
