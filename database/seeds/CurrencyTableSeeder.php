<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = array(
            // array('id' => '1','name' => 'Kuwaiti dinar', 'iso' => 'KWD','symbol' => 'KD' ,'rate' => 0),
            // array('id' => '2','name' => 'Dollar', 'iso' => 'USD','symbol' => '$','rate' => 0),
            // array('id' => '3','name' => 'Euro','iso' => 'EUR','symbol' => '€','rate' => 0),
            // array('id' => '4','name' => 'British pound','iso' => 'GBP','symbol' => '£','rate' => 0),
            // array('id' => '5','name' => 'Bahraini dinar','iso' => 'BHD','symbol' => 'BD','rate' => 0),
            // array('id' => '6','name' => 'Omani rial','iso' => 'OMR','symbol' => 'ر.ع.','rate' => 0),
            // array('id' => '7','name' => 'Qatari Riyal','iso' => 'QAR','symbol' => 'QR','rate' => 0),
            // array('id' => '8','name' => 'United Arab Emirates dirham','iso' => 'AED','symbol' => 'د.إ','rate' => 0),
            array('id' => '9','name' => 'Saudi Riyal','iso' => 'SAR','symbol' => 'SR','rate' => 0),
        );
        DB::table('currencies')->insert($currencies);
    }
}
