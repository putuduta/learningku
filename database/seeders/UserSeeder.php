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
                'user_code'=> '555556665555555',
                'name' => 'Natalia Desi Aryani',
                'email' => 'desi@gmail.com',
                'gender' => 'Female',
                'role_id' => '2',
                'password' => Hash::make('desi5543'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '555554447755555',
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
                'user_code'=> '0056315326',
                'name' => 'Benedictus Nathaniel Xu',
                'email' => 'benedictus@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '00643462212',
                'name' => 'Briant Yoel Mula Halomoan Sitompul',
                'email' => 'briant@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0031256124',
                'name' => 'Christianus Abel Datu Putra Adhityaswara',
                'email' => 'christianus@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0077101550',
                'name' => 'Delza Abigail Suryono',
                'email' => 'delza@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0012952225',
                'name' => 'Emanuel Yoga Mahardhika',
                'email' => 'emanuel@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0012386281',
                'name' => 'Emmanuela Aliana Manullang',
                'email' => 'emmanuela@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0043120363',
                'name' => 'Gabrielle Dorasima Manullang',
                'email' => 'gabrielle@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0058002098',
                'name' => 'Gavriella Meilida Sitorus',
                'email' => 'gavriella@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0067505698',
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
                'user_code'=> '0065585909',
                'name' => 'Janetta Lirianya Putri Siahaan',
                'email' => 'janetta@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0087989414',
                'name' => 'Jefanya Malau',
                'email' => 'jefanya@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0078924616',
                'name' => 'Jeremy Julio Caesar Tarigan',
                'email' => 'jeremy@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0111223255',
                'name' => 'Jimmy Stephen',
                'email' => 'jimmy@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0064444054',
                'name' => 'Jovanka Florecita Gunawan',
                'email' => 'jovanka@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '9033307971',
                'name' => 'Lance Ayson Winarto',
                'email' => 'lance@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0055542812',
                'name' => 'Marcello Jonathan Mulia',
                'email' => 'marcello@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0067770910',
                'name' => 'Nathaniel Rudolf Solata Mangari',
                'email' => 'nathaniel@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0066611967',
                'name' => 'Raphael Nicku Ariadhi',
                'email' => 'raphael@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0066669784',
                'name' => 'Renata Sandyanputri',
                'email' => 'renata@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0067777231',
                'name' => 'Sevira',
                'email' => 'sevira@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0067773057',
                'name' => 'Shawn Michael Pesik',
                'email' => 'shawn@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0066662461',
                'name' => 'Stefanus Hendro Wibowo',
                'email' => 'stefanus@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0065596168',
                'name' => 'Stefhanie Chintya Eliza',
                'email' => 'stefhanie@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0067777774',
                'name' => 'Teodosius Adifta Tjandra',
                'email' => 'teodosius@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0067777210',
                'name' => 'Trevian Fernando',
                'email' => 'trevian@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0068888833',
                'name' => 'Vallerie Mae Widjaja',
                'email' => 'vallerie@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0064444706',
                'name' => 'William Jonathan Sugiharto',
                'email' => 'william@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0069199979',
                'name' => 'Yosef Wisnu Fandy Chrisanto',
                'email' => 'yosef@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '0067551925',
                'name' => 'Edward Melvin Gandakusuma',
                'email' => 'edward@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '9748755555300032',
                'name' => 'Gabriella Nina Suharlina',
                'email' => 'nina@gmail.com',
                'gender' => 'Female',
                'role_id' => '2',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '555553335555555',
                'name' => 'Idang Indrianto',
                'email' => 'idang@gmail.com',
                'gender' => 'Male',
                'role_id' => '2',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '555554445555555',
                'name' => 'Petty Fefiyana',
                'email' => 'petty@gmail.com',
                'gender' => 'Female',
                'role_id' => '2',
                'password' => Hash::make('bhklearningku'),
                'school' => 'SMA BHK KOTA WISATA'
            ],
            [
                'user_code'=> '555555555555555',
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
