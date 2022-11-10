<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Genre::create([
            'name' => 'Action'
        ]);

        Genre::create([
            'name' => 'Romance'
        ]);

        Genre::create([
            'name' => 'Horror'
        ]);

        Genre::create([
            'name' => 'Comedy'
        ]);

        Genre::create([
            'name' => 'Drama'
        ]);
        Genre::create([
            'name' => 'Adventure'
        ]);
    }
}
