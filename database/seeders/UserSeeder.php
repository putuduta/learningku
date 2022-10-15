<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Budi',
                'email' => 'budi@gmail.com',
                'role' => 'Teacher',
                'password' => Hash::make('kualat'),
            ],
            [
                'name' => 'Andre',
                'email' => 'andre@gmail.com',
                'role' => 'Teacher',
                'password' => Hash::make('kualat'),
            ],
            [
                'name' => 'John',
                'email' => 'john@gmail.com',
                'role' => 'Student',
                'password' => Hash::make('kualat'),
            ],
            [
                'name' => 'Claire',
                'email' => 'claire@gmail.com',
                'role' => 'Student',
                'password' => Hash::make('kualat'),
            ],
            [
                'name' => 'James',
                'email' => 'james@gmail.com',
                'role' => 'Student',
                'password' => Hash::make('kualat'),
            ],
        ]);
    }
}
