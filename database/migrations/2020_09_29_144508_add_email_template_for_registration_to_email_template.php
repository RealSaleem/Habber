<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailTemplateForRegistrationToEmailTemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('email_templates')->insert([
            "content" => "<p>Hi mName,<br />
            <br />
            <br />
            <p>Congratulations! You are Registered!.
            <br />
            <p>Email: mEmail</p>
            </p><p><a href='http://investadmin.attribes.com/'>Click here to Login</a></p> ",
            "name" => "User Registration",
            "subject" => "You are Registered",
            "is_active" => 1,
            "key" => "user_reg"
        ]); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_template', function (Blueprint $table) {
            //
        });
    }
}
