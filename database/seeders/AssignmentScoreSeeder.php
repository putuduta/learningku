<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignmentScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assignment_scores')->insert([
            [
                'assignment_header_id' => 1,
                'student_user_id' => 4,
                'score' => '90',
            ],
            [
                'assignment_header_id' => 1,
                'student_user_id' => 5,
                'score' => '88',
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 6,
                'score' => '86'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 7,
                'score' => '95'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 8,
                'score' => '98'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 9,
                'score' => '98'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 10,
                'score' => '90'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 11,
                'score' => '95'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 12,
                'score' => '90'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 13,
                'score' => '90'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 14,
                'score' => '85'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 15,
                'score' => '85'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 16,
                'score' => '80'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 17,
                'score' => '90'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 18,
                'score' => '92'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 19,
                'score' => '95'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 20,
                'score' => '98'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 21,
                'score' => '88'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 22,
                'score' => '88'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 23,
                'score' => '85'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 24,
                'score' => '82'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 25,
                'score' => '80'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 26,
                'score' => '90'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 27,
                'score' => '95'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 28,
                'score' => '98'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 29,
                'score' => '88'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 30,
                'score' => '88'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 31,
                'score' => '90'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 32,
                'score' => '92'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 33,
                'score' => '80'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 34,
                'score' => '80'
            ]
        ]);
    }
}
