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
                'class_id' => '1',
                'date' => '23-01-24',
            ],
            [
                'class_id' => '1',
                'date' => '23-01-25',
            ],
            [
                'class_id' => '1',
                'date' => '23-01-26',
            ]
        ]);
        DB::table('attendance_details')->insert([
            [
                'attendance_id' => '1',
                'user_id' => '3',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '1',
                'user_id' => '4',
                'is_attend' => 1
            ],            [
                'attendance_id' => '2',
                'user_id' => '3',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '2',
                'user_id' => '4',
                'is_attend' => 0
            ],            [
                'attendance_id' => '3',
                'user_id' => '3',
                'is_attend' => 1
            ],
            [
                'attendance_id' => '3',
                'user_id' => '4',
                'is_attend' => 1
            ]
        ]);
    }
}
