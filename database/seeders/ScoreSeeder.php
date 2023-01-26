<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('scores')->insert([
            [
                'class_header_id' => 1,
                'student_id' => 3,
                'score_name' => 'Ulangan matematika diskrit minggu 1',
                'score' => 90,
            ],            
            [
                'class_header_id' => 1,
                'student_id' => 4,
                'score_name' => 'Ulangan matematika diskrit minggu 1',
                'score' => 95,
            ],
            [
                'class_header_id' => 1,
                'student_id' => 3,
                'score_name' => 'Ulangan matematika diskrit minggu 2',
                'score' => 80,
            ],            
            [
                'class_header_id' => 1,
                'student_id' => 4,
                'score_name' => 'Ulangan matematika diskrit minggu 2',
                'score' => 98,
            ],
        ]);
    }
}
