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
            'actor_id' => 1,
            'movie_id' => 1,
            'char_name' => 'dobby'
        ]);

        MovieActor::create([
            'actor_id' => 2,
            'movie_id' => 1,
            'char_name' => 'rawwfe'
        ]);

        MovieActor::create([
            'actor_id' => 1,
            'movie_id' => 2,
            'char_name' => 'loving'
        ]);

        MovieActor::create([
            'actor_id' => 2,
            'movie_id' => 3,
            'char_name' => 'Jacky'
        ]);
    }
}
