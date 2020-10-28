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
                'status'     => true,
            ]);

        $english = Language::create([
                'name'     => 'english',
                'status'     => true,
            ]);
    }
}
