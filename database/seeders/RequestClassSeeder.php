<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequestClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('request_classes')->insert([
            [
                'student_id' => 5,
                'class_id' => 1,
                'status' => 'New Request',
                'comment' => 'Nama saya: James dari kelas Matematika B',
            ],
            [
                'student_id' => 3,
                'class_id' => 1,
                'status' => 'Approved',
                'comment' => 'Nama saya: John dari kelas Matematika B',
            ],
            [
                'student_id' => 4,
                'class_id' => 1,
                'status' => 'Approved',
                'comment' => 'Nama saya: Claire dari kelas Matematika B',
            ]
        ]);
    }
}
