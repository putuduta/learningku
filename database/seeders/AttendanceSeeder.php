<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attendance_headers')->insert([
            [
                'class_subject_id' => '1',
                'date' => '23-03-28',
            ],
            [
                'class_subject_id' => '1',
                'date' => '23-04-04',
            ]
        ]);
        DB::table('attendance_details')->insert([
            [
                'attendance_id' => '1',
                'student_user_id' => '4',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '5',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '6',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '7',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '8',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '9',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '10',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '11',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '12',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '13',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '14',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '15',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '16',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '17',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '18',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '19',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '20',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '21',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '22',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '23',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '24',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '25',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '26',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '27',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '28',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '29',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '30',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '31',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '32',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '33',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '34',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '4',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '5',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '6',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '7',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '8',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '9',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '10',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '11',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '12',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '13',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '14',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '15',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '16',
                'is_attend' => 0
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '17',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '18',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '19',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '20',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '21',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '22',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '23',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '24',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '25',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '26',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '27',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '28',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '29',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '30',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '31',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '32',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '33',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '34',
                'is_attend' => 1
            ]
        ]);
    }
}
