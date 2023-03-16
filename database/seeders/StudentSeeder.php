<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            [
                'user_id' => '4',
                'nisn' => '9996278635'
            ],
            [
                'user_id' => '5',
                'nisn' => '0006781224'
            ]
        ]);
    }
}
