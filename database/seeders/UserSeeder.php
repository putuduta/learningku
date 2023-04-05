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
        DB::table('users')->insert([
            [
                'name' => 'Agus',
                'email' => 'agus@gmail.com',
                'gender' => 'Male',
                'role_id' => '1',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Natalia Desi Aryani',
                'email' => 'desi@gmail.com',
                'gender' => 'Female',
                'role_id' => '2',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Ambar Prasetyaningsih',
                'email' => 'ambar@gmail.com',
                'gender' => 'Female',
                'role_id' => '2',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Beben Rafli Luhut Tua Sianipar',
                'email' => 'beben@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Benedictus Nathaniel Xu',
                'email' => 'benedictus@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Briant Yoel Mula Halomoan Sitompul',
                'email' => 'briant@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Christianus Abel Datu Putra Adhityaswara',
                'email' => 'christianus@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Delza Abigail Suryono',
                'email' => 'delza@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Emanuel Yoga Mahardhika',
                'email' => 'emanuel@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Emmanuela Aliana Manullang',
                'email' => 'emmanuela@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Gabrielle Dorasima Manullang',
                'email' => 'gabrielle@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Gavriella Meilida Sitorus',
                'email' => 'gavriella@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Giovanni Joaquine Mulya',
                'email' => 'giovanni@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Irene Evelina',
                'email' => 'irene@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Janetta Lirianya Putri Siahaan',
                'email' => 'janetta@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Jefanya Malau',
                'email' => 'jefanya@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Jeremy Julio Caesar Tarigan',
                'email' => 'jeremy@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Jimmy Stephen',
                'email' => 'jimmy@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Jovanka Florecita Gunawan',
                'email' => 'jovanka@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Lance Ayson Winarto',
                'email' => 'lance@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Marcello Jonathan Mulia',
                'email' => 'marcello@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Nathaniel Rudolf Solata Mangari',
                'email' => 'nathaniel@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Raphael Nicku Ariadhi',
                'email' => 'raphael@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Renata Sandyanputri',
                'email' => 'renata@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Sevira',
                'email' => 'sevira@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Shawn Michael Pesik',
                'email' => 'shawn@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Stefanus Hendro Wibowo',
                'email' => 'stefanus@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Stefhanie Chintya Eliza',
                'email' => 'stefhanie@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Teodosius Adifta Tjandra',
                'email' => 'teodosius@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Trevian Fernando',
                'email' => 'trevian@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Vallerie Mae Widjaja',
                'email' => 'vallerie@gmail.com',
                'gender' => 'Female',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'William Jonathan Sugiharto',
                'email' => 'william@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Yosef Wisnu Fandy Chrisanto',
                'email' => 'yosef@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Edward Melvin Gandakusuma',
                'email' => 'edward@gmail.com',
                'gender' => 'Male',
                'role_id' => '3',
                'password' => Hash::make('kualat')
            ],
            [
                'name' => 'Gabriella Nina Suharlina',
                'email' => 'nina@gmail.com',
                'gender' => 'Female',
                'role_id' => '2',
                'password' => Hash::make('kualat')
            ]
        ]);
    }
}
