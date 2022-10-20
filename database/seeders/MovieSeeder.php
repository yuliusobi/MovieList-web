<?php

namespace Database\Seeders;

use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::create([
            'title' => 'Harry Potter',
            'desc' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa',
            'director' => 'Loise poety',
            'released_date' => Carbon::parse('2013-05-05'),
            'thumb_img' => 'https://source.unsplash.com/200x350?',
            'bg_img' => 'https://source.unsplash.com/1500x400?'
        ]);

        Movie::create([
            'title' => 'Harry Potter 2',
            'desc' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa',
            'director' => 'Loise poety',
            'released_date' => Carbon::parse('2007-02-07'),
            'thumb_img' => 'https://source.unsplash.com/200x350?',
            'bg_img' => 'https://source.unsplash.com/1500x400?'
        ]);


        Movie::create([
            'title' => 'Harry Potter 3',
            'desc' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa',
            'director' => 'Loise poety',
            'released_date' => Carbon::parse('2013-05-13'),
            'thumb_img' => 'https://source.unsplash.com/200x350?',
            'bg_img' => 'https://source.unsplash.com/1500x400?'
        ]);


    }
}
