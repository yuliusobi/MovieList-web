<?php

namespace Database\Seeders;

use App\Models\MovieActor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MovieActor::create([
            'movie_id' => 1,
            'actor_id' => 1,
            'char_name' => 'Diana'
        ]);

        MovieActor::create([
            'movie_id' => 2,
            'actor_id' => 2,
            'char_name' => 'Jack Sparrow'
        ]);

        MovieActor::create([
            'movie_id' => 2,
            'actor_id' => 4,
            'char_name' => 'Elizabeth Swann'
        ]);

        MovieActor::create([
            'movie_id' => 3,
            'actor_id' => 3,
            'char_name' => 'Jack Dawson'
        ]);

        MovieActor::create([
            'movie_id' => 4,
            'actor_id' => 1,
            'char_name' => 'The Bishop'
        ]);
    }
}
