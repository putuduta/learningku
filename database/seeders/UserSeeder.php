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
                'name' => 'Vincent',
                'email' => 'vincent@gmail.com',
                'reg_number' => '0',
                'phone_number' => '91028391203',
                'role_id' => 1,
                'institution_id' => 1,
                'class_id' => NULL,
                'password' => Hash::make('kualat'),
            ],
            [
                'name' => 'Budi',
                'email' => '`budi1@gmail.com`',
                'reg_number' => '200010192001',
                'phone_number' => '082219100022',
                'role_id' => 2,
                'institution_id' => 1,
                'class_id' => NULL,
                'password' => Hash::make('kualat'),
            ],
            [
                'name' => 'John',
                'email' => 'john2@gmail.com',
                'reg_number' => '233813392001',
                'phone_number' => '081119193332',
                'role_id' => 3,
                'institution_id' => 1,
                'class_id' => 1,
                'password' => Hash::make('kualat'),
            ],
            [
                'name' => 'James',
                'email' => 'james1@gmail.com',
                'reg_number' => '23333194401',
                'phone_number' => '08112551922',
                'role_id' => 3,
                'institution_id' => 1,
                'class_id' => 1,
                'password' => Hash::make('kualat'),
            ],
        ]);
    }
}
