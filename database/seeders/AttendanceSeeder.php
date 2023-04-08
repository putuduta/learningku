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
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '5',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '6',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '7',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '8',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '9',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '10',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '11',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '12',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '13',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '14',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '15',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '16',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '17',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '18',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '19',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '20',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '21',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '22',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '23',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '24',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '25',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '26',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '27',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '28',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '29',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '30',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '31',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '32',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '33',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '34',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '4',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '5',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '6',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '7',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '8',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '9',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '10',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '11',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '12',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '13',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '14',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '15',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '16',
                'status' => 'Absent'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '17',
                'status' => 'Sick'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '18',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '19',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '20',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '1',
                'student_user_id' => '21',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '22',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '23',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '24',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '25',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '26',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '27',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '28',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '29',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '30',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '31',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '32',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '33',
                'status' => 'Present'
            ],
            [
                'attendance_id' => '2',
                'student_user_id' => '34',
                'status' => 'Present'
            ]
        ]);
    }
}
