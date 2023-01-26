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
                'title' => 'Matematika Diskrit Logika (logic) dan penalaran',
                'description' => 'Logika
                Perhatikan argumen di bawah ini:
                Jika anda mahasiswa Informatika maka anda
                tidak sulit belajar Bahasa Java. Jika anda tidak
                suka begadang maka anda bukan mahasiswa
                Informatika. Tetapi, anda sulit belajar Bahasa
                Java dan anda tidak suka begadang. Jadi, anda
                bukan mahasiswa Informatika.
                Apakah kesimpulan dari argumen di atas valid?
                Alat bantu untuk memahami argumen tsb
                adalah Logika',
                'resource' => ''
            ],
            [
                'class_id' => 1,
                'title' => 'Matematika Diskrit Logika (logic) dan penalaran Teori Himpunan (set)',
                'description' => 'Definisi himpunan. Himpunan (set) adalah kumpulan objek-objek yang berbeda. Objek di dalam himpunan disebut elemen, unsur, atau anggota. HIMATIF adalah contoh sebuah himpunan, di dalamnya berisi anggota berupa mahasiswa. Tiap mahasiswa berbeda satu sama lain.',
                'resource' => ''
            ]
        ]);
    }
}
