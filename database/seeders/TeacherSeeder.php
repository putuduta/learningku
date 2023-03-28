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
                'nuptk' => '5241756659200013',
                'last_education' => 'Sarjana S1',
                'position' => 'Staff Tata Usaha',
                'subject_taught' => 'Matematika'
            ],
            [
                'user_id' => '3',
                'nuptk' => '7746749651300092',
                'last_education' => 'Sarjana S1',
                'position' => 'Guru',
                'subject_taught' => 'Bahasa Indonesia'
            ]
        ]);
    }
}
