<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            [
                'user_id' => '4',
                'nisn' => '0064345599'
            ],
            [
                'user_id' => '5',
                'nisn' => '0056315346'
            ],
            [
                'user_id' => '6',
                'nisn' => '0065465212'
            ],
            [
                'user_id' => '7',
                'nisn' => '0051456124'
            ],
            [
                'user_id' => '8',
                'nisn' => '0066001550'
            ],
            [
                'user_id' => '9',
                'nisn' => '0062952225'
            ],
            [
                'user_id' => '10',
                'nisn' => '0064286281'
            ],
            [
                'user_id' => '11',
                'nisn' => '0068520363'
            ],
            [
                'user_id' => '12',
                'nisn' => '0064002098'
            ],
            [
                'user_id' => '13',
                'nisn' => '0063805698'
            ],
            [
                'user_id' => '14',
                'nisn' => '0064121035'
            ],
            [
                'user_id' => '15',
                'nisn' => '0064085909'
            ],
            [
                'user_id' => '16',
                'nisn' => '0061189414'
            ],
            [
                'user_id' => '17',
                'nisn' => '0065024616'
            ],
            [
                'user_id' => '18',
                'nisn' => '0061223255'
            ],
            [
                'user_id' => '19',
                'nisn' => '0064338054'
            ],
            [
                'user_id' => '20',
                'nisn' => '009019207971'
            ],
            [
                'user_id' => '21',
                'nisn' => '0055842812'
            ],
            [
                'user_id' => '22',
                'nisn' => '0067070910'
            ],
            [
                'user_id' => '23',
                'nisn' => '0068911967'
            ],
            [
                'user_id' => '24',
                'nisn' => '0069509784'
            ],
            [
                'user_id' => '25',
                'nisn' => '0067157231'
            ],
            [
                'user_id' => '26',
                'nisn' => '0067133057'
            ],
            [
                'user_id' => '27',
                'nisn' => '0062152461'
            ],
            [
                'user_id' => '28',
                'nisn' => '0063596168'
            ],
            [
                'user_id' => '29',
                'nisn' => '0067739874'
            ],
            [
                'user_id' => '30',
                'nisn' => '0067751210'
            ],
            [
                'user_id' => '31',
                'nisn' => '0068891133'
            ],
            [
                'user_id' => '32',
                'nisn' => '0064402706'
            ],
            [
                'user_id' => '33',
                'nisn' => '0069196179'
            ],
            [
                'user_id' => '34',
                'nisn' => '0067541925'
            ]
        ]);
    }
}
