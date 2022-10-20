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
            'username' => 'iniuser2',
            'email' => 'user2@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        User::create([
            'username' => 'iniuser3',
            'email' => 'iniuser3@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

    }
}
