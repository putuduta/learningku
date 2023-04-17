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
                'end_time' => '2023-02-01T23:59',
                'created_at' => '2023-01-15 07:00:10',
                'updated_at' => '2023-01-15 07:00:10'
            ],
            [
                'class_subject_id' => '1',
                'title' => 'Writing Connection',
                'file' => 'ASG_Writing Connection_1680855997.txt',
                'end_time' => '2023-02-15T23:59',
                'created_at' => '2023-02-01 15:26:38',
                'updated_at' => '2023-02-01 15:26:38'
            ],
            [
                'class_subject_id' => '1',
                'title' => 'Offers & Suggestions',
                'file' => 'ASG_Offers & Suggestions_1681679311.txt',
                'end_time' => '2023-03-01T23:59',
                'created_at' => '2023-02-17 04:07:38',
                'updated_at' => '2023-02-17 04:07:38'
            ],
            [
                'class_subject_id' => '1',
                'title' => 'Opinions & Thoughts',
                'file' => 'ASG_Opinions & Thoughts_1681679635.txt',
                'end_time' => '2023-03-15T23:59',
                'created_at' => '2023-03-01 04:07:38',
                'updated_at' => '2023-03-01 04:07:38'
            ],
            [
                'class_subject_id' => '1',
                'title' => 'Types of Invitations',
                'file' => 'ASG_Types of Invitations_1681679775.txt',
                'end_time' => '2023-04-01T23:59',
                'created_at' => '2023-03-15 04:07:38',
                'updated_at' => '2023-03-15 04:07:38'
            ]
        ]);
        DB::table('assignment_details')->insert([
            [
                'assignment_header_id' => 1,
                'student_user_id' => 4,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-28 17:58:10',
                'updated_at' => '2023-01-28 17:58:10'
            ],
            [
                'assignment_header_id' => 1,
                'student_user_id' => 5,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-28 18:58:10',
                'updated_at' => '2023-01-28 18:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 6,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-29 16:58:10',
                'updated_at' => '2023-01-29 16:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 7,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-29 02:58:10',
                'updated_at' => '2023-01-29 02:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 8,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-30 17:59:10',
                'updated_at' => '2023-01-30 17:59:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 9,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-28 12:58:10',
                'updated_at' => '2023-01-28 12:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 10,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-31 17:00:10',
                'updated_at' => '2023-01-31 17:00:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 11,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-28 11:58:10',
                'updated_at' => '2023-01-28 11:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 12,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-28 12:59:10',
                'updated_at' => '2023-01-28 12:59:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 13,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-27 15:58:10',
                'updated_at' => '2023-01-27 15:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 14,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-29 13:58:10',
                'updated_at' => '2023-01-29 13:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 15,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-28 10:58:10',
                'updated_at' => '2023-01-28 10:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 16,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-27 11:58:10',
                'updated_at' => '2023-01-27 11:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 17,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-28 14:48:10',
                'updated_at' => '2023-01-28 14:48:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 18,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-28 18:58:10',
                'updated_at' => '2023-01-28 18:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 19,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-29 19:58:10',
                'updated_at' => '2023-01-29 19:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 20,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-28 22:58:10',
                'updated_at' => '2023-01-28 22:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 21,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-28 23:58:10',
                'updated_at' => '2023-01-28 23:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 22,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-29 22:18:10',
                'updated_at' => '2023-01-29 22:18:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 23,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-01 17:58:10',
                'updated_at' => '2023-01-01 17:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 24,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-01 22:58:10',
                'updated_at' => '2023-01-01 22:58:10',
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 25,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-01 11:58:10',
                'updated_at' => '2023-01-01 11:58:10'
            ],                 [
                'assignment_header_id' => 1,
                'student_user_id' => 26,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-31 11:58:10',
                'updated_at' => '2023-01-31 11:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 27,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-31 22:58:10',
                'updated_at' => '2023-01-31 22:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 28,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-31 12:58:10',
                'updated_at' => '2023-01-31 12:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 29,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-31 21:58:10',
                'updated_at' => '2023-01-31 21:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 30,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-31 10:58:10',
                'updated_at' => '2023-01-31 10:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 31,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-31 23:58:10',
                'updated_at' => '2023-01-31 23:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 32,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-29 12:58:10',
                'updated_at' => '2023-01-29 12:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 33,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-30 11:58:10',
                'updated_at' => '2023-01-30 11:58:10'
            ],            [
                'assignment_header_id' => 1,
                'student_user_id' => 34,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-01 07:58:10',
                'updated_at' => '2023-02-30 07:58:10'
            ],
            [
                'assignment_header_id' => 2,
                'student_user_id' => 4,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-01 17:58:10',
                'updated_at' => '2023-02-01 17:58:10'
            ],
            [
                'assignment_header_id' => 2,
                'student_user_id' => 5,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-01 18:58:10',
                'updated_at' => '2023-02-01 18:58:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 6,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-02 17:58:10',
                'updated_at' => '2023-02-02 17:58:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 7,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-02 12:38:10',
                'updated_at' => '2023-02-02 12:38:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 8,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-02 21:58:10',
                'updated_at' => '2023-02-0221:58:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 9,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-04-02 11:59:10',
                'updated_at' => '2023-04-02 11:59:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 10,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-02 13:48:10',
                'updated_at' => '2023-02-02 13:48:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 11,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-05 11:58:10',
                'updated_at' => '2023-02-05 11:58:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 12,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-05 12:51:10',
                'updated_at' => '2023-02-05 12:51:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 13,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-07 12:18:10',
                'updated_at' => '2023-02-07 12:18:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 14,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-07 11:11:10',
                'updated_at' => '2023-02-07 11:11:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 15,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-13 10:33:10',
                'updated_at' => '2023-02-13 10:33:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 16,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-13 22:18:20',
                'updated_at' => '2023-02-13 22:18:20'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 17,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 05:58:10',
                'updated_at' => '2023-02-14 05:58:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 18,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 13:58:10',
                'updated_at' => '2023-02-14 13:58:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 19,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 11:18:10',
                'updated_at' => '2023-02-14 11:18:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 20,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 19:38:10',
                'updated_at' => '2023-02-14 19:38:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 21,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 17:28:10',
                'updated_at' => '2023-02-14 17:28:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 22,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 16:18:10',
                'updated_at' => '2023-02-14 16:18:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 23,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-13 15:28:10',
                'updated_at' => '2023-02-13 15:28:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 24,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-13 15:58:10',
                'updated_at' => '2023-02-13 15:58:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 25,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-13 08:58:10',
                'updated_at' => '2023-02-13 08:58:10'
            ],                 [
                'assignment_header_id' => 2,
                'student_user_id' => 26,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-13 06:58:10',
                'updated_at' => '2023-02-13 06:58:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 27,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 07:58:10',
                'updated_at' => '2023-02-14 07:58:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 28,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 01:38:10',
                'updated_at' => '2023-02-14 01:38:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 29,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 21:38:10',
                'updated_at' => '2023-02-14 21:38:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 30,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 11:58:10',
                'updated_at' => '2023-02-14 11:58:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 31,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 04:58:10',
                'updated_at' => '2023-02-14 04:58:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 32,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-13 03:58:10',
                'updated_at' => '2023-02-13 03:58:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 33,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-13 22:58:10',
                'updated_at' => '2023-02-13 22:58:10'
            ],            [
                'assignment_header_id' => 2,
                'student_user_id' => 34,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-13 11:58:10',
                'updated_at' => '2023-02-13 12:58:10'
            ]
        ]);
    }
}
