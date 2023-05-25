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
                'user_id' => 2
            ]
        ]);
        DB::table('class_subject')->insert([
            [
                'name' => 'Bahasa Inggris',
                'class_header_id' => 1,
                'user_id' => 2,
                'minimum_score' => 75
            ],
            [
                'name' => 'Kimia', 
                'class_header_id' => 1,
                'user_id' => 3,
                'minimum_score' => 75
            ],
            [
                'name' => 'Matematika Wajib',
                'class_header_id' => 1,
                'user_id' => 35,
                'minimum_score' => 75
            ]
        ]);
        DB::table('class_details')->insert([
            [
                'user_id' => '4',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '5',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '6',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '7',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '8',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '9',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '10',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '11',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '12',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '13',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '14',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '15',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '16',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '17',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '18',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '19',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '20',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '21',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '22',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '23',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '24',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '25',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '26',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '27',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '28',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '29',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '30',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '31',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '32',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '33',
                'class_header_id' => '1'
            ],
            [
                'user_id' => '34',
                'class_header_id' => '1'
            ]
        ]);
    }
}
