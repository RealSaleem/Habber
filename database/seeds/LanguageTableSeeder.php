<?php

use Illuminate\Database\Seeder;
use App\Language;
class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arabic = Language::create([
                'name'     => 'arabic',
                'iso'       => 'ar',
                'status'     => true,
            ]);

        $english = Language::create([
                'name'     => 'english',
                'iso'       => 'en',
                'status'     => true,
            ]);
    }
}
