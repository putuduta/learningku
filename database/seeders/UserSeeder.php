<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            [
                'user_code'=> abs(crc32(uniqid())),
                'name' => 'Agustinus Dwi Wibowo',
                'email' => 'agus@gmail.com',
                'gender' => 'Male',
                'role_id' => '1',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '5543758660300003',
                'name' => 'Natalia Desi Aryani',
                'email' => 'desi@gmail.com',
                'gender' => 'Female',
                'role_id' => '2',
                'password' => Hash::make('desi5543'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '8347762663230123',
                'name' => 'Ambar Prasetyaningsih',
                'email' => 'ambar@gmail.com',
                'gender' => 'Female',
                'role_id' => '2',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0064345599',
                'name' => 'Beben Rafli Luhut Tua Sianipar',
                'email' => 'beben@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0056315346',
                'name' => 'Benedictus Nathaniel Xu',
                'email' => 'benedictus@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0065465212',
                'name' => 'Briant Yoel Mula Halomoan Sitompul',
                'email' => 'briant@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0051456124',
                'name' => 'Christianus Abel Datu Putra Adhityaswara',
                'email' => 'christianus@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0066001550',
                'name' => 'Delza Abigail Suryono',
                'email' => 'delza@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0062952225',
                'name' => 'Emanuel Yoga Mahardhika',
                'email' => 'emanuel@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0064286281',
                'name' => 'Emmanuela Aliana Manullang',
                'email' => 'emmanuela@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0068520363',
                'name' => 'Gabrielle Dorasima Manullang',
                'email' => 'gabrielle@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0064002098',
                'name' => 'Gavriella Meilida Sitorus',
                'email' => 'gavriella@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0063805698',
                'name' => 'Giovanni Joaquine Mulya',
                'email' => 'giovanni@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0064121035',
                'name' => 'Irene Evelina',
                'email' => 'irene@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0064085909',
                'name' => 'Janetta Lirianya Putri Siahaan',
                'email' => 'janetta@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0061189414',
                'name' => 'Jefanya Malau',
                'email' => 'jefanya@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0065024616',
                'name' => 'Jeremy Julio Caesar Tarigan',
                'email' => 'jeremy@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0061223255',
                'name' => 'Jimmy Stephen',
                'email' => 'jimmy@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0064338054',
                'name' => 'Jovanka Florecita Gunawan',
                'email' => 'jovanka@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '9019207971',
                'name' => 'Lance Ayson Winarto',
                'email' => 'lance@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0055842812',
                'name' => 'Marcello Jonathan Mulia',
                'email' => 'marcello@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0067070910',
                'name' => 'Nathaniel Rudolf Solata Mangari',
                'email' => 'nathaniel@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0068911967',
                'name' => 'Raphael Nicku Ariadhi',
                'email' => 'raphael@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0069509784',
                'name' => 'Renata Sandyanputri',
                'email' => 'renata@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0067157231',
                'name' => 'Sevira',
                'email' => 'sevira@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0067133057',
                'name' => 'Shawn Michael Pesik',
                'email' => 'shawn@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0062152461',
                'name' => 'Stefanus Hendro Wibowo',
                'email' => 'stefanus@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0063596168',
                'name' => 'Stefhanie Chintya Eliza',
                'email' => 'stefhanie@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0067739874',
                'name' => 'Teodosius Adifta Tjandra',
                'email' => 'teodosius@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0067751210',
                'name' => 'Trevian Fernando',
                'email' => 'trevian@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0068891133',
                'name' => 'Vallerie Mae Widjaja',
                'email' => 'vallerie@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0064402706',
                'name' => 'William Jonathan Sugiharto',
                'email' => 'william@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0069196179',
                'name' => 'Yosef Wisnu Fandy Chrisanto',
                'email' => 'yosef@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0067541925',
                'name' => 'Edward Melvin Gandakusuma',
                'email' => 'edward@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '9748755657300032',
                'name' => 'Gabriella Nina Suharlina',
                'email' => 'nina@gmail.com',
                'gender' => 'Female',
                'role_id' => '2',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '9950152433915650',
                'name' => 'Idang Indrianto',
                'email' => 'idang@gmail.com',
                'gender' => 'Male',
                'role_id' => '2',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '4907254123960419',
                'name' => 'Petty Fefiyana',
                'email' => 'petty@gmail.com',
                'gender' => 'Female',
                'role_id' => '2',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '6748554856315829',
                'name' => 'Bernadette Ririn',
                'email' => 'bernadette@gmail.com',
                'gender' => 'Female',
                'role_id' => '2',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ]
        ]);
    }
}
