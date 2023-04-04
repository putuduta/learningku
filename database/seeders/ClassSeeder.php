<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('class_headers')->insert([
            [
                'name' => 'XI IPA 2',
                'school_year_id' => 1,
                'homeroom_teacher_id' => 2
            ]
        ]);
        DB::table('class_subjects')->insert([
            [
                'name' => 'Bahasa Ingris',
                'description' => "Perkembangan dunia pendidikan dan era teknologi informasi saat ini, semakin meningkatkan peran bahasa Inggris dalam pembelajaran, mengingat banyak sekali sumber belajar dalam bahasa Inggris dibanding sumber-sumber lainnya. Makin datarnya dunia dengan teknologi informasi dan komunikasi menyebabkan pergaulan tidak lagi dapat dibatasi oleh batasan-batasan negara, dan hal ini semakin meningkatkan kebutuhan terhadap penguasaan bahasa Inggris sebagai bahasa pergaulan dunia.",
                'class_header_id' => 1,
                'teacher_user_id' => 2
            ],
            [
                'name' => 'Kimia',
                'description' => "Kimia SMA merupakan mata pelajaran wajib yang dipelajari oleh siswa siswi SMA pada kelas 10, 11 dan 12. Secara garis besar, gambaran materi kimia yang dipelajari di SMA cukup beragam. Seperti kimia unsur, ikatan kimia, kesetimbangan kimia, bilangan kuantum, struktur atom, teori atom, hukum dasar kimia, dll.",
                'class_header_id' => 1,
                'teacher_user_id' => 3
            ],
            [
                'name' => 'Matematika Wajib',
                'description' => "Pembelajaran matematika bertujuan agar siswa memiliki kecakapan dan kemampuan di bidang matematika yang merupakan bagian dari kecakapan hidup yang harus dimiliki siswa terutama dalam pengembangan penalaran, komunikasi, dan pemecahan masalah yang dihadapi dalam kehidupan sehari-hari",
                'class_header_id' => 1,
                'teacher_user_id' => 35
            ]
        ]);
        DB::table('class_details')->insert([
            [
                'student_user_id' => '4',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '5',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '6',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '7',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '8',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '9',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '10',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '11',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '12',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '13',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '14',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '15',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '16',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '17',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '18',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '19',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '20',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '21',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '22',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '23',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '24',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '25',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '26',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '27',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '28',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '29',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '30',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '31',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '32',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '33',
                'class_header_id' => '1'
            ],
            [
                'student_user_id' => '34',
                'class_header_id' => '1'
            ]
        ]);
    }
}
