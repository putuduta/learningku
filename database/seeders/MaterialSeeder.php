<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('materials')->insert([
            [
                'class_id' => 1,
                'title' => 'BAB 1',
                'description' => 'Calculus',
                'resource' => ''
            ],
            [
                'class_id' => 1,
                'title' => 'BAB 2',
                'description' => 'Aritmatika',
                'resource' => ''
            ]
        ]);
    }
}
