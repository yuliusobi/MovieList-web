<?php

namespace Database\Seeders;

use App\Models\MovieGenre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MovieGenre::create([
            'genre_id' => 1,
            'movie_id' => 1
        ]);

        MovieGenre::create([
            'genre_id' => 2,
            'movie_id' => 1
        ]);

        MovieGenre::create([
            'genre_id' => 1,
            'movie_id' => 2
        ]);

        MovieGenre::create([
            'genre_id' => 3,
            'movie_id' => 3
        ]);

        MovieGenre::create([
            'genre_id' => 2,
            'movie_id' => 3
        ]);
    }
}
