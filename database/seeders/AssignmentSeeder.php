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
                'class_subject_id' => '1',
                'title' => 'Membuat Personal Letter',
                'file' => 'ASG_Membuat Personal Letter_1680605006.txt',
                'end_time' => '2023-04-01T23:59',
                'created_at' => '2023-03-27 07:00:10',
                'updated_at' => '2023-03-27 07:00:10'
            ]
        ]);
        DB::table('assignment_details')->insert([
            [
                'assignment_id' => 1,
                'student_user_id' => 4,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-28 17:58:10',
                'updated_at' => '2023-03-28 17:58:10'
            ],
            [
                'assignment_id' => 1,
                'student_user_id' => 5,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-28 18:58:10',
                'updated_at' => '2023-03-28 18:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 6,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-29 16:58:10',
                'updated_at' => '2023-03-29 16:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 7,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-29 02:58:10',
                'updated_at' => '2023-03-29 02:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 8,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-30 17:59:10',
                'updated_at' => '2023-03-30 17:59:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 9,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-28 12:58:10',
                'updated_at' => '2023-03-28 12:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 10,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-31 17:00:10',
                'updated_at' => '2023-03-31 17:00:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 11,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-28 11:58:10',
                'updated_at' => '2023-03-28 11:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 12,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-28 12:59:10',
                'updated_at' => '2023-03-28 12:59:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 13,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-27 15:58:10',
                'updated_at' => '2023-03-27 15:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 14,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-29 13:58:10',
                'updated_at' => '2023-03-29 13:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 15,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-28 10:58:10',
                'updated_at' => '2023-03-28 10:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 16,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-27 11:58:10',
                'updated_at' => '2023-03-27 11:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 17,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-28 14:48:10',
                'updated_at' => '2023-03-28 14:48:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 18,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-28 18:58:10',
                'updated_at' => '2023-03-28 18:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 19,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-29 19:58:10',
                'updated_at' => '2023-03-29 19:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 20,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-28 22:58:10',
                'updated_at' => '2023-03-28 22:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 21,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-28 23:58:10',
                'updated_at' => '2023-03-28 23:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 22,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-29 22:18:10',
                'updated_at' => '2023-03-29 22:18:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 23,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-04-01 17:58:10',
                'updated_at' => '2023-04-01 17:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 24,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-04-01 22:58:10',
                'updated_at' => '2023-04-01 22:58:10',
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 25,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-04-01 11:58:10',
                'updated_at' => '2023-04-01 11:58:10'
            ],                 [
                'assignment_id' => 1,
                'student_user_id' => 26,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-31 11:58:10',
                'updated_at' => '2023-03-31 11:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 27,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-31 22:58:10',
                'updated_at' => '2023-03-31 22:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 28,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-31 12:58:10',
                'updated_at' => '2023-03-31 12:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 29,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-31 21:58:10',
                'updated_at' => '2023-03-31 21:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 30,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-31 10:58:10',
                'updated_at' => '2023-03-31 10:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 31,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-31 23:58:10',
                'updated_at' => '2023-03-31 23:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 32,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-29 12:58:10',
                'updated_at' => '2023-03-29 12:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 33,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-30 11:58:10',
                'updated_at' => '2023-03-30 11:58:10'
            ],            [
                'assignment_id' => 1,
                'student_user_id' => 34,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-30 07:58:10',
                'updated_at' => '2023-03-30 07:58:10'
            ]
        ]);
    }
}
