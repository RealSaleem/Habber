<?php

use App\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genre= Genre::create([
            'title' => 'General',
            'arabic_title' => 'جنرال لواء'
        ]);
    }
}
