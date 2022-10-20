<?php

namespace Database\Seeders;

use App\Models\Actor;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Actor::create([
            'name' => 'Obi',
            'bio' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa',
            'gender' => 'Male',
            'dob' => Carbon::parse('2000-01-01'),
            'place_of_birth' => 'Tangerang',
            'popularity' => 7
        ]);

        Actor::create([
            'name' => 'doddy',
            'bio' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa',
            'gender' => 'Female',
            'dob' => Carbon::parse('2000-01-01'),
            'place_of_birth' => 'Tangerang',
            'popularity' => 3
        ]);
    }
}
