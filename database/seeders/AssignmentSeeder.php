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
        DB::table('assignment_header')->insert([
            [
                'class_subject_id' => '1',
                'title' => 'Personal Letter',
                'file' => 'ASG_Membuat Personal Letter_1680605006.txt',
                'end_time' => '2023-02-01T23:59',
                'created_at' => '2023-01-15 07:00:10',
                'updated_at' => '2023-01-15 07:00:10'
            ],
            [
                'class_subject_id' => '1',
                'title' => 'Cause & Effect',
                'file' => 'ASG_Cause & Effects_1681679311',
                'end_time' => '2023-02-15T23:59',
                'created_at' => '2023-02-01 15:26:38',
                'updated_at' => '2023-02-01 15:26:38'
            ],
            [
                'class_subject_id' => '1',
                'title' => 'Meaning Through Music',
                'file' => 'ASG_Meaning Through Music_1681679635',
                'end_time' => '2023-03-01T23:59',
                'created_at' => '2023-02-17 04:07:38',
                'updated_at' => '2023-02-17 04:07:38'
            ],
            [
                'class_subject_id' => '1',
                'title' => 'Writing Connection',
                'file' => 'ASG_Writing Connection_1680855997.txt',
                'end_time' => '2023-03-15T23:59',
                'created_at' => '2023-03-01 04:07:38',
                'updated_at' => '2023-03-01 04:07:38'
            ],
            [
                'class_subject_id' => '1',
                'title' => 'Enrichment',
                'file' => 'ASG_ENRICHMENT_1680855997.docx',
                'end_time' => '2023-04-01T23:59',
                'created_at' => '2023-03-15 04:07:38',
                'updated_at' => '2023-03-15 04:07:38'
            ],
            [
                'class_subject_id' => '2',
                'title' => 'Asam dan Basa',
                'file' => 'ASG_Asam dan Basa.txt',
                'end_time' => '2023-03-01T23:59',
                'created_at' => '2023-02-15 07:00:10',
                'updated_at' => '2023-02-15 07:00:10'
            ],
            [
                'class_subject_id' => '2',
                'title' => 'Larutan Penyangga',
                'file' => 'ASG_Larutan Penyangga.txt',
                'end_time' => '2023-03-15T23:59',
                'created_at' => '2023-03-01 15:26:38',
                'updated_at' => '2023-03-01 15:26:38'
            ],
            [
                'class_subject_id' => '2',
                'title' => 'Titrasi',
                'file' => 'ASG_Titrasi.txt',
                'end_time' => '2023-04-01T23:59',
                'created_at' => '2023-03-17 04:07:38',
                'updated_at' => '2023-03-17 04:07:38'
            ],
            [
                'class_subject_id' => '2',
                'title' => 'Larutan Garam',
                'file' => 'ASG_Larutan Garam.txt',
                'end_time' => '2023-06-01T23:59',
                'created_at' => '2023-05-17 04:07:38',
                'updated_at' => '2023-05-17 04:07:38'
            ],
            [
                'class_subject_id' => '2',
                'title' => 'Kesetimbangan Kelarutan',
                'file' => 'ASG_Kesetimbangan Kelarutan.txt',
                'end_time' => '2023-06-02T23:59',
                'created_at' => '2023-05-17 04:08:38',
                'updated_at' => '2023-05-17 04:08:38'
            ]
        ]);
        DB::table('assignment_detail')->insert([
            [
                'assignment_header_id' => 1,
                'user_id' => 4,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-28 17:58:10',
                'updated_at' => '2023-01-28 17:58:10'
            ],
            [
                'assignment_header_id' => 1,
                'user_id' => 5,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-28 18:58:10',
                'updated_at' => '2023-01-28 18:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 6,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-29 16:58:10',
                'updated_at' => '2023-01-29 16:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 7,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-29 02:58:10',
                'updated_at' => '2023-01-29 02:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 8,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-30 17:59:10',
                'updated_at' => '2023-01-30 17:59:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 9,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-28 12:58:10',
                'updated_at' => '2023-01-28 12:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 10,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-31 17:00:10',
                'updated_at' => '2023-01-31 17:00:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 11,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-28 11:58:10',
                'updated_at' => '2023-01-28 11:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 12,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-28 12:59:10',
                'updated_at' => '2023-01-28 12:59:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 13,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-27 15:58:10',
                'updated_at' => '2023-01-27 15:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 14,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-29 13:58:10',
                'updated_at' => '2023-01-29 13:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 15,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-28 10:58:10',
                'updated_at' => '2023-01-28 10:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 16,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-27 11:58:10',
                'updated_at' => '2023-01-27 11:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 17,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-28 14:48:10',
                'updated_at' => '2023-01-28 14:48:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 18,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-28 18:58:10',
                'updated_at' => '2023-01-28 18:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 19,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-29 19:58:10',
                'updated_at' => '2023-01-29 19:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 20,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-28 22:58:10',
                'updated_at' => '2023-01-28 22:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 21,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-28 23:58:10',
                'updated_at' => '2023-01-28 23:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 22,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-29 22:18:10',
                'updated_at' => '2023-01-29 22:18:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 23,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-01 17:58:10',
                'updated_at' => '2023-01-01 17:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 24,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-01 22:58:10',
                'updated_at' => '2023-01-01 22:58:10',
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 25,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-01 11:58:10',
                'updated_at' => '2023-01-01 11:58:10'
            ],                 [
                'assignment_header_id' => 1,
                'user_id' => 26,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-31 11:58:10',
                'updated_at' => '2023-01-31 11:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 27,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-31 22:58:10',
                'updated_at' => '2023-01-31 22:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 28,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-31 12:58:10',
                'updated_at' => '2023-01-31 12:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 29,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-31 21:58:10',
                'updated_at' => '2023-01-31 21:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 30,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-31 10:58:10',
                'updated_at' => '2023-01-31 10:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 31,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-31 23:58:10',
                'updated_at' => '2023-01-31 23:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 32,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-29 12:58:10',
                'updated_at' => '2023-01-29 12:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 33,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-30 11:58:10',
                'updated_at' => '2023-01-30 11:58:10'
            ],            [
                'assignment_header_id' => 1,
                'user_id' => 34,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-01-30 07:58:10',
                'updated_at' => '2023-01-30 07:58:10'
            ],
            [
                'assignment_header_id' => 2,
                'user_id' => 4,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-01 17:58:10',
                'updated_at' => '2023-02-01 17:58:10'
            ],
            [
                'assignment_header_id' => 2,
                'user_id' => 5,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-01 18:58:10',
                'updated_at' => '2023-02-01 18:58:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 6,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-02 17:58:10',
                'updated_at' => '2023-02-02 17:58:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 7,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-02 12:38:10',
                'updated_at' => '2023-02-02 12:38:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 8,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-02 21:58:10',
                'updated_at' => '2023-02-02 21:58:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 9,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-04-02 11:59:10',
                'updated_at' => '2023-04-02 11:59:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 10,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-02 13:48:10',
                'updated_at' => '2023-02-02 13:48:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 11,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-05 11:58:10',
                'updated_at' => '2023-02-05 11:58:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 12,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-05 12:51:10',
                'updated_at' => '2023-02-05 12:51:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 13,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-07 12:18:10',
                'updated_at' => '2023-02-07 12:18:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 14,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-07 11:11:10',
                'updated_at' => '2023-02-07 11:11:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 15,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-13 10:33:10',
                'updated_at' => '2023-02-13 10:33:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 16,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-13 22:18:20',
                'updated_at' => '2023-02-13 22:18:20'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 17,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 05:58:10',
                'updated_at' => '2023-02-14 05:58:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 18,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 13:58:10',
                'updated_at' => '2023-02-14 13:58:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 19,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 11:18:10',
                'updated_at' => '2023-02-14 11:18:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 20,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 19:38:10',
                'updated_at' => '2023-02-14 19:38:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 21,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 17:28:10',
                'updated_at' => '2023-02-14 17:28:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 22,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 16:18:10',
                'updated_at' => '2023-02-14 16:18:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 23,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-13 15:28:10',
                'updated_at' => '2023-02-13 15:28:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 24,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-13 15:58:10',
                'updated_at' => '2023-02-13 15:58:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 25,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-13 08:58:10',
                'updated_at' => '2023-02-13 08:58:10'
            ],                 [
                'assignment_header_id' => 2,
                'user_id' => 26,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-13 06:58:10',
                'updated_at' => '2023-02-13 06:58:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 27,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 07:58:10',
                'updated_at' => '2023-02-14 07:58:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 28,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 01:38:10',
                'updated_at' => '2023-02-14 01:38:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 29,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 21:38:10',
                'updated_at' => '2023-02-14 21:38:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 30,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 11:58:10',
                'updated_at' => '2023-02-14 11:58:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 31,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-14 04:58:10',
                'updated_at' => '2023-02-14 04:58:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 32,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-13 03:58:10',
                'updated_at' => '2023-02-13 03:58:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 33,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-13 22:58:10',
                'updated_at' => '2023-02-13 22:58:10'
            ],            [
                'assignment_header_id' => 2,
                'user_id' => 34,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-13 11:58:10',
                'updated_at' => '2023-02-13 12:58:10'
            ],
            [
                'assignment_header_id' => 3,
                'user_id' => 4,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-27 19:58:10',
                'updated_at' => '2023-02-27 19:58:10'
            ],
            [
                'assignment_header_id' => 3,
                'user_id' => 5,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-27 20:58:10',
                'updated_at' => '2023-02-27 20:58:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 6,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-27 21:58:10',
                'updated_at' => '2023-02-27 21:58:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 7,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-24 13:38:10',
                'updated_at' => '2023-02-24 13:38:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 8,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-24 14:58:10',
                'updated_at' => '2023-02-24 14:58:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 9,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-20 15:59:10',
                'updated_at' => '2023-02-20 15:59:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 10,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-24 13:48:10',
                'updated_at' => '2023-02-24 13:48:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 11,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-26 11:58:10',
                'updated_at' => '2023-02-26 11:58:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 12,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-26 12:51:10',
                'updated_at' => '2023-02-26 12:51:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 13,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-27 12:18:10',
                'updated_at' => '2023-02-27 12:18:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 14,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-27 11:11:10',
                'updated_at' => '2023-02-27 11:11:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 15,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-28 10:33:10',
                'updated_at' => '2023-02-28 10:33:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 16,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-28 22:18:20',
                'updated_at' => '2023-02-28 22:18:20'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 17,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-27 05:58:10',
                'updated_at' => '2023-02-27 05:58:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 18,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-27 13:58:10',
                'updated_at' => '2023-02-27 13:58:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 19,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-27 11:18:10',
                'updated_at' => '2023-02-27 11:18:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 20,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-27 19:38:10',
                'updated_at' => '2023-02-27 19:38:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 21,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-27 17:28:10',
                'updated_at' => '2023-02-27 17:28:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 22,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-27 16:18:10',
                'updated_at' => '2023-02-27 16:18:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 23,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-28 15:28:10',
                'updated_at' => '2023-02-28 15:28:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 24,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-28 15:58:10',
                'updated_at' => '2023-02-28 15:58:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 25,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-28 08:58:10',
                'updated_at' => '2023-02-28 08:58:10'
            ],                 [
                'assignment_header_id' => 3,
                'user_id' => 26,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-28 06:58:10',
                'updated_at' => '2023-02-28 06:58:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 27,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-27 07:58:10',
                'updated_at' => '2023-02-27 07:58:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 28,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-27 01:38:10',
                'updated_at' => '2023-02-27 01:38:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 29,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-27 21:38:10',
                'updated_at' => '2023-02-27 21:38:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 30,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-27 11:58:10',
                'updated_at' => '2023-02-27 11:58:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 31,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-27 04:58:10',
                'updated_at' => '2023-02-27 04:58:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 32,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-28 03:58:10',
                'updated_at' => '2023-02-28 03:58:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 33,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-28 22:58:10',
                'updated_at' => '2023-02-28 22:58:10'
            ],            [
                'assignment_header_id' => 3,
                'user_id' => 34,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-02-28 11:58:10',
                'updated_at' => '2023-02-28 12:58:10'
            ],
            [
                'assignment_header_id' => 4,
                'user_id' => 4,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-01 19:58:10',
                'updated_at' => '2023-03-01 19:58:10'
            ],
            [
                'assignment_header_id' => 4,
                'user_id' => 5,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-01 20:58:10',
                'updated_at' => '2023-03-01 20:58:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 6,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-02 21:58:10',
                'updated_at' => '2023-03-02 21:58:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 7,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-02 13:38:10',
                'updated_at' => '2023-03-02 13:38:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 8,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-02 14:58:10',
                'updated_at' => '2023-03-02 14:58:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 9,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-04-02 15:59:10',
                'updated_at' => '2023-04-02 15:59:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 10,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-02 13:48:10',
                'updated_at' => '2023-03-02 13:48:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 11,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-05 11:58:10',
                'updated_at' => '2023-03-05 11:58:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 12,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-05 12:51:10',
                'updated_at' => '2023-03-05 12:51:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 13,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-07 12:18:10',
                'updated_at' => '2023-03-07 12:18:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 14,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-07 11:11:10',
                'updated_at' => '2023-03-07 11:11:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 15,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-13 10:33:10',
                'updated_at' => '2023-03-13 10:33:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 16,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-13 22:18:20',
                'updated_at' => '2023-03-13 22:18:20'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 17,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-14 05:58:10',
                'updated_at' => '2023-03-14 05:58:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 18,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-14 13:58:10',
                'updated_at' => '2023-03-14 13:58:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 19,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-14 11:18:10',
                'updated_at' => '2023-03-14 11:18:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 20,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-14 19:38:10',
                'updated_at' => '2023-03-14 19:38:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 21,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-14 17:28:10',
                'updated_at' => '2023-03-14 17:28:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 22,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-14 16:18:10',
                'updated_at' => '2023-03-14 16:18:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 23,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-13 15:28:10',
                'updated_at' => '2023-03-13 15:28:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 24,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-13 15:58:10',
                'updated_at' => '2023-03-13 15:58:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 25,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-13 08:58:10',
                'updated_at' => '2023-03-13 08:58:10'
            ],                 [
                'assignment_header_id' => 4,
                'user_id' => 26,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-13 06:58:10',
                'updated_at' => '2023-03-13 06:58:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 27,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-14 07:58:10',
                'updated_at' => '2023-03-14 07:58:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 28,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-14 01:38:10',
                'updated_at' => '2023-03-14 01:38:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 29,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-14 21:38:10',
                'updated_at' => '2023-03-14 21:38:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 30,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-14 11:58:10',
                'updated_at' => '2023-03-14 11:58:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 31,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-14 04:58:10',
                'updated_at' => '2023-03-14 04:58:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 32,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-13 03:58:10',
                'updated_at' => '2023-03-13 03:58:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 33,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-13 22:58:10',
                'updated_at' => '2023-03-13 22:58:10'
            ],            [
                'assignment_header_id' => 4,
                'user_id' => 34,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-13 11:58:10',
                'updated_at' => '2023-03-13 12:58:10'
            ],
            [
                'assignment_header_id' => 5,
                'user_id' => 4,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-30 16:58:10',
                'updated_at' => '2023-03-30 16:58:10'
            ],
            [
                'assignment_header_id' => 5,
                'user_id' => 5,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-30 10:58:10',
                'updated_at' => '2023-03-30 10:58:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 6,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-30 11:58:10',
                'updated_at' => '2023-03-30 11:58:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 7,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-24 13:38:10',
                'updated_at' => '2023-03-24 13:38:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 8,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-24 14:58:10',
                'updated_at' => '2023-03-24 14:58:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 9,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-20 15:59:10',
                'updated_at' => '2023-03-20 15:59:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 10,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-24 13:48:10',
                'updated_at' => '2023-03-24 13:48:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 11,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-26 11:58:10',
                'updated_at' => '2023-03-26 11:58:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 12,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-26 12:51:10',
                'updated_at' => '2023-03-26 12:51:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 13,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-30 12:18:10',
                'updated_at' => '2023-03-30 12:18:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 14,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-30 11:11:10',
                'updated_at' => '2023-03-30 11:11:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 15,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-28 10:33:10',
                'updated_at' => '2023-03-28 10:33:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 16,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-28 22:18:20',
                'updated_at' => '2023-03-28 22:18:20'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 17,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-30 05:58:10',
                'updated_at' => '2023-03-30 05:58:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 18,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-30 13:58:10',
                'updated_at' => '2023-03-30 13:58:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 19,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-30 11:18:10',
                'updated_at' => '2023-03-30 11:18:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 20,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-30 19:38:10',
                'updated_at' => '2023-03-30 19:38:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 21,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-30 17:28:10',
                'updated_at' => '2023-03-30 17:28:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 22,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-30 16:18:10',
                'updated_at' => '2023-03-30 16:18:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 23,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-28 15:28:10',
                'updated_at' => '2023-03-28 15:28:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 24,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-28 15:58:10',
                'updated_at' => '2023-03-28 15:58:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 25,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-28 08:58:10',
                'updated_at' => '2023-03-28 08:58:10'
            ],                 [
                'assignment_header_id' => 5,
                'user_id' => 26,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-28 06:58:10',
                'updated_at' => '2023-03-28 06:58:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 30,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-30 07:58:10',
                'updated_at' => '2023-03-30 07:58:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 28,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-30 01:38:10',
                'updated_at' => '2023-03-30 01:38:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 29,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-30 21:38:10',
                'updated_at' => '2023-03-30 21:38:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 30,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-30 11:58:10',
                'updated_at' => '2023-03-30 11:58:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 31,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-30 04:58:10',
                'updated_at' => '2023-03-30 04:58:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 32,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-28 03:58:10',
                'updated_at' => '2023-03-28 03:58:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 33,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-28 22:58:10',
                'updated_at' => '2023-03-28 22:58:10'
            ],            [
                'assignment_header_id' => 5,
                'user_id' => 34,
                'file' => 'SUB_ASG_Membuat Personal Letter_34_1680605251.txt',
                'created_at' => '2023-03-28 11:58:10',
                'updated_at' => '2023-03-28 12:58:10'
            ],
            [
                'assignment_header_id' => 6,
                'user_id' => 4,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 17:58:10',
                'updated_at' => '2023-02-28 17:58:10'
            ],
            [
                'assignment_header_id' => 6,
                'user_id' => 5,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 18:58:10',
                'updated_at' => '2023-02-28 18:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 6,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 16:58:10',
                'updated_at' => '2023-02-28 16:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 7,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 02:58:10',
                'updated_at' => '2023-02-28 02:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 8,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-03-01 08:59:10',
                'updated_at' => '2023-03-01 08:59:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 9,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 12:58:10',
                'updated_at' => '2023-02-28 12:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 10,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 17:00:10',
                'updated_at' => '2023-02-28 17:00:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 11,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 11:58:10',
                'updated_at' => '2023-02-28 11:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 12,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 12:59:10',
                'updated_at' => '2023-02-28 12:59:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 13,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-27 15:58:10',
                'updated_at' => '2023-02-27 15:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 14,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 13:58:10',
                'updated_at' => '2023-02-28 13:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 15,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 10:58:10',
                'updated_at' => '2023-02-28 10:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 16,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-27 11:58:10',
                'updated_at' => '2023-02-27 11:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 17,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 14:48:10',
                'updated_at' => '2023-02-28 14:48:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 18,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 18:58:10',
                'updated_at' => '2023-02-28 18:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 19,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 19:58:10',
                'updated_at' => '2023-02-28 19:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 20,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 22:58:10',
                'updated_at' => '2023-02-28 22:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 21,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 23:58:10',
                'updated_at' => '2023-02-28 23:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 22,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 22:18:10',
                'updated_at' => '2023-02-28 22:18:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 23,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-01 17:58:10',
                'updated_at' => '2023-02-01 17:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 24,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-01 22:58:10',
                'updated_at' => '2023-02-01 22:58:10',
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 25,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-01 11:58:10',
                'updated_at' => '2023-02-01 11:58:10'
            ],                 [
                'assignment_header_id' => 6,
                'user_id' => 26,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 11:58:10',
                'updated_at' => '2023-02-28 11:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 27,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 22:58:10',
                'updated_at' => '2023-02-28 22:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 28,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 12:58:10',
                'updated_at' => '2023-02-28 12:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 29,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 21:58:10',
                'updated_at' => '2023-02-28 21:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 30,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 10:58:10',
                'updated_at' => '2023-02-28 10:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 31,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 23:58:10',
                'updated_at' => '2023-02-28 23:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 32,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-02-28 12:58:10',
                'updated_at' => '2023-02-28 12:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 33,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-03-01 11:58:10',
                'updated_at' => '2023-03-01 11:58:10'
            ],            [
                'assignment_header_id' => 6,
                'user_id' => 34,
                'file' => 'SUB_ASG_Asam dan Basa_34_1680605251.txt',
                'created_at' => '2023-03-01 07:58:10',
                'updated_at' => '2023-03-01 07:58:10'
            ],
            [
                'assignment_header_id' => 7,
                'user_id' => 4,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-01 17:58:10',
                'updated_at' => '2023-03-01 17:58:10'
            ],
            [
                'assignment_header_id' => 7,
                'user_id' => 5,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-01 18:58:10',
                'updated_at' => '2023-03-01 18:58:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 6,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-02 17:58:10',
                'updated_at' => '2023-03-02 17:58:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 7,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-02 12:38:10',
                'updated_at' => '2023-03-02 12:38:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 8,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-02 21:58:10',
                'updated_at' => '2023-03-02 21:58:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 9,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-04-02 11:59:10',
                'updated_at' => '2023-04-02 11:59:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 10,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-02 13:48:10',
                'updated_at' => '2023-03-02 13:48:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 11,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-05 11:58:10',
                'updated_at' => '2023-03-05 11:58:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 12,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-05 12:51:10',
                'updated_at' => '2023-03-05 12:51:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 13,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-07 12:18:10',
                'updated_at' => '2023-03-07 12:18:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 14,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-07 11:11:10',
                'updated_at' => '2023-03-07 11:11:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 15,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-13 10:33:10',
                'updated_at' => '2023-03-13 10:33:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 16,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-13 22:18:20',
                'updated_at' => '2023-03-13 22:18:20'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 17,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-14 05:58:10',
                'updated_at' => '2023-03-14 05:58:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 18,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-14 13:58:10',
                'updated_at' => '2023-03-14 13:58:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 19,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-14 11:18:10',
                'updated_at' => '2023-03-14 11:18:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 20,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-14 19:38:10',
                'updated_at' => '2023-03-14 19:38:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 21,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-14 17:28:10',
                'updated_at' => '2023-03-14 17:28:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 22,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-14 16:18:10',
                'updated_at' => '2023-03-14 16:18:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 23,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-13 15:28:10',
                'updated_at' => '2023-03-13 15:28:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 24,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-13 15:58:10',
                'updated_at' => '2023-03-13 15:58:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 25,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-13 08:58:10',
                'updated_at' => '2023-03-13 08:58:10'
            ],                 [
                'assignment_header_id' => 7,
                'user_id' => 26,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-13 06:58:10',
                'updated_at' => '2023-03-13 06:58:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 27,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-14 07:58:10',
                'updated_at' => '2023-03-14 07:58:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 28,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-14 01:38:10',
                'updated_at' => '2023-03-14 01:38:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 29,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-14 21:38:10',
                'updated_at' => '2023-03-14 21:38:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 30,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-14 11:58:10',
                'updated_at' => '2023-03-14 11:58:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 31,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-14 04:58:10',
                'updated_at' => '2023-03-14 04:58:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 32,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-13 03:58:10',
                'updated_at' => '2023-03-13 03:58:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 33,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-13 22:58:10',
                'updated_at' => '2023-03-13 22:58:10'
            ],            [
                'assignment_header_id' => 7,
                'user_id' => 34,
                'file' => 'SUB_ASG_Larutan Penyangga_34_1680605251.txt',
                'created_at' => '2023-03-13 11:58:10',
                'updated_at' => '2023-03-13 12:58:10'
            ],
            [
                'assignment_header_id' => 8,
                'user_id' => 4,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-27 19:58:10',
                'updated_at' => '2023-03-27 19:58:10'
            ],
            [
                'assignment_header_id' => 8,
                'user_id' => 5,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-27 20:58:10',
                'updated_at' => '2023-03-27 20:58:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 6,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-27 21:58:10',
                'updated_at' => '2023-03-27 21:58:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 7,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-24 13:38:10',
                'updated_at' => '2023-03-24 13:38:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 8,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-24 14:58:10',
                'updated_at' => '2023-03-24 14:58:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 9,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-20 15:59:10',
                'updated_at' => '2023-03-20 15:59:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 10,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-24 13:48:10',
                'updated_at' => '2023-03-24 13:48:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 11,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-26 11:58:10',
                'updated_at' => '2023-03-26 11:58:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 12,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-26 12:51:10',
                'updated_at' => '2023-03-26 12:51:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 13,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-27 12:18:10',
                'updated_at' => '2023-03-27 12:18:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 14,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-27 11:11:10',
                'updated_at' => '2023-03-27 11:11:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 15,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-28 10:33:10',
                'updated_at' => '2023-03-28 10:33:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 16,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-28 22:18:20',
                'updated_at' => '2023-03-28 22:18:20'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 17,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-27 05:58:10',
                'updated_at' => '2023-03-27 05:58:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 18,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-27 13:58:10',
                'updated_at' => '2023-03-27 13:58:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 19,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-27 11:18:10',
                'updated_at' => '2023-03-27 11:18:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 20,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-27 19:38:10',
                'updated_at' => '2023-03-27 19:38:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 21,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-27 17:28:10',
                'updated_at' => '2023-03-27 17:28:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 22,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-27 16:18:10',
                'updated_at' => '2023-03-27 16:18:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 23,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-28 15:28:10',
                'updated_at' => '2023-03-28 15:28:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 24,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-28 15:58:10',
                'updated_at' => '2023-03-28 15:58:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 25,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-28 08:58:10',
                'updated_at' => '2023-03-28 08:58:10'
            ],                 [
                'assignment_header_id' => 8,
                'user_id' => 26,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-28 06:58:10',
                'updated_at' => '2023-03-28 06:58:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 27,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-27 07:58:10',
                'updated_at' => '2023-03-27 07:58:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 28,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-27 01:38:10',
                'updated_at' => '2023-03-27 01:38:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 29,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-27 21:38:10',
                'updated_at' => '2023-03-27 21:38:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 30,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-27 11:58:10',
                'updated_at' => '2023-03-27 11:58:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 31,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-27 04:58:10',
                'updated_at' => '2023-03-27 04:58:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 32,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-28 03:58:10',
                'updated_at' => '2023-03-28 03:58:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 33,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-28 22:58:10',
                'updated_at' => '2023-03-28 22:58:10'
            ],            [
                'assignment_header_id' => 8,
                'user_id' => 34,
                'file' => 'SUB_ASG_Titrasi_34_1680605251.txt',
                'created_at' => '2023-03-28 11:58:10',
                'updated_at' => '2023-03-28 12:58:10'
            ],
        ]);
    }
}
