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
                'name' => 'Matematika B',
                'description' => 'Kelas pak Budi guru matematika di sekolah Andals',
                'teacher_id' => 1,
                'guid' => bin2hex(random_bytes('16')),
            ],
            [
                'name' => 'Matematika X',
                'description' => 'Kelas pak Andre guru matematika di sekolah Andals',
                'teacher_id' => 2,
                'guid' => bin2hex(random_bytes('16')),
            ],
        ]);
        DB::table('class_details')->insert([
            [
                'class_header_id' => 1,
                'student_id' => 3,
            ],
            [
                'class_header_id' => 1,
                'student_id' => 4,
            ],
        ]);
    }
}
