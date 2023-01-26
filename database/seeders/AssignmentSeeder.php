<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assignment_headers')->insert([
            [
                'class_id' => '1',
                'title' => 'Tugas Minggu 1',
                'file' => 'ASG_Tugas 1_1674705598.docx',
                'end_time' => '2023-01-31T23:59',
            ],
            [
                'class_id' => '1',
                'title' => 'Tugas Minggu 2',
                'file' => 'ASG_Test_1674662154.docx',
                'end_time' => '2023-02-31T23:59',
            ],
        ]);
        DB::table('assignment_details')->insert([
            [
                'assignment_id' => 1,
                'user_id' => 3,
                'file' => 'SUB_ASG_Tugas 1_3_1674706077.docx'
            ],
            [
                'assignment_id' => 2,
                'user_id' => 4,
                'file' => 'SUB_ASG_Coding Looping_12_1621942658.jpg'
            ]
        ]);
    }
}
