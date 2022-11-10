<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'obiadmin',
            'email' => 'obi@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        User::create([
            'username' => 'suma',
            'email' => 'suma@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        User::create([
            'username' => 'user3',
            'email' => 'user3@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        User::create([
            'username' => 'user4',
            'email' => 'user4@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

    }
}
