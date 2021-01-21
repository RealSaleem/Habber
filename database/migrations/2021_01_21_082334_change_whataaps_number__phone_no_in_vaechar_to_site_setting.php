<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeWhataapsNumberPhoneNoInVaecharToSiteSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('site_settings','phone_no')) {
            DB::statement("ALTER TABLE `site_settings` CHANGE `phone_no` `phone_no` VARCHAR(20) NOT NULL;");
        }
        if(Schema::hasColumn('site_settings','whatsaap_number')) {
            DB::statement("ALTER TABLE `site_settings` CHANGE `whatsaap_number` `whatsaap_number` VARCHAR(20) NOT NULL;");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            //
        });
    }
}
