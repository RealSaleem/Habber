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
            array('id' => '1','name' => 'Kuwaiti dinar', 'iso' => 'KWD','symbol' => 'KD'),
            array('id' => '2','name' => 'Dollar', 'iso' => 'USD','symbol' => '$'),
            array('id' => '3','name' => 'Euro','iso' => 'EUR','symbol' => '€'),
            array('id' => '4','name' => 'British pound','iso' => 'GBP','symbol' => '£'),
            array('id' => '5','name' => 'Bahraini dinar','iso' => 'BHD','symbol' => 'BD'),
            array('id' => '6','name' => 'Omani rial','iso' => 'OMR','symbol' => 'ر.ع.'),
            array('id' => '7','name' => 'Qatari Riyal','iso' => 'QAR','symbol' => 'QR'),
            array('id' => '8','name' => 'United Arab Emirates dirham','iso' => 'AED','symbol' => 'د.إ'),
        );
        DB::table('currencies')->insert($currencies);
    }
}
