<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        $this->call(PermissionTableSeeder::class);
        // $this->call(GenreSeeder::class);
        // $this->call(LanguageTableSeeder::class);
        // $this->call(CountryTableSeeder::class);
        $this->call(AdminSeeder::class);
        // $this->call(CurrencyTableSeeder::class);
        // $this->call(SiteSettingSeeder::class);
    }
}
