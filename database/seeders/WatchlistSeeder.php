<?php

namespace Database\Seeders;

use App\Models\Watchlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WatchlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Watchlist::create([
            'user_id' => 3,
            'movie_id' => '2',
            'status' => 'Planned'
        ]);

        Watchlist::create([
            'user_id' => 3,
            'movie_id' => '3',
            'status' => 'Finished'
        ]);

        Watchlist::create([
            'user_id' => 3,
            'movie_id' => '1',
            'status' => 'Watching'
        ]);

        Watchlist::create([
            'user_id' => 4,
            'movie_id' => '1',
            'status' => 'Planned'
        ]);
    }
}
