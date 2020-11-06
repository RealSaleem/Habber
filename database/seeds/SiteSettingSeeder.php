<?php

use Illuminate\Database\Seeder;
use App\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = SiteSetting::create([
            'email'     => 'hebber@gmail.com',
            'language'     => 1,
            'currency'      => 1,
            'phone_no'         => 0211112233,
            'whatsaap_number'   => 0211010101,
            'snapchat_url'      => 'https://snapchat.com',
            'facebook_url'      => 'https://facebook.com',
            'instagram_url'      => 'https://instagram.com',   
            'twitter_url'      => 'https://twitter.com',   
        ]);
    }
}
