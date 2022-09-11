<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('institutions')->insert([
            [
                'name' => 'SMA Negeri 100',
                'email' => 'smanegeri100@gmail.com',
                'address' => 'Jalan A No. 10',
                'phone_number' => '08229191919',
            ],
            [
                'name' => 'SMA Negeri 200',
                'email' => 'smanegeri200@gmail.com',
                'address' => 'Jalan B No. 20',
                'phone_number' => '08233391919',
            ],
        ]);
    }
}
