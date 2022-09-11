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
        DB::table('class_details')->insert([
            [
                'name' => '12 IPA 2',
                'homeroom_id' => 2,
                'institution_id' => 1,
            ],
        ]);
    }
}
