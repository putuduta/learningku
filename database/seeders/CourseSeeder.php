<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{

    public function run()
    {
        DB::table('courses')->insert([
            [
                'name' => 'Mathematics',
            ],
            [
                'name' => 'Physics',
            ],
            [
                'name' => 'Sosiology',
            ],
        ]);
    }
}
