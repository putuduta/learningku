<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([
            [
                'user_id' => '2',
                'nuptk' => '5241756659200013'
            ],
            [
                'user_id' => '3',
                'nuptk' => '7746749651300092'
            ]
        ]);
    }
}
