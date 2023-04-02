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
                'nuptk' => '5543758660300003',
                'last_education' => 'Sarjana S1',
                'position' => 'Guru',
                'subject_taught' => 'Bahasa Inggris'
            ],
            [
                'user_id' => '3',
                'nuptk' => '8347762663230123',
                'last_education' => 'Sarjana S1',
                'position' => 'Guru',
                'subject_taught' => 'Kimia'
            ],
            [
                'user_id' => '35',
                'nuptk' => '9748755657300032',
                'last_education' => 'Sarjana S1',
                'position' => 'Guru',
                'subject_taught' => 'Matematika Wajib'
            ]
        ]);
    }
}
