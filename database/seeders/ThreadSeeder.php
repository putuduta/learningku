<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forums')->insert([
            [
                'class_id' => 1,
                'user_id' => 1,
                'title' => 'MATEMATIKA DISKRIT',
                'body' => 'Matematika diskrit atau diskret adalah cabang matematika yang membahas segala sesuatu yang bersifat diskrit. Diskrit disini artinya tidak saling berhubungan (lawan dari kontinu). Objek yang dibahas dalam Matematika Diskrit - seperti bilangan bulat, graf, atau kalimat logika - tidak berubah secara kontinu, tetapi memiliki nilai yang tertentu dan terpisah. Beberapa hal yang dibahas dalam matematika ini adalah teori himpunan, teori kombinatorial, teori bilangan, permutasi, fungsi, rekursif, teori graf, dan lain-lain. Matematika diskrit merupakan mata kuliah utama dan dasar untuk bidang ilmu komputer atau informatika. Menurut teman-teman apa itu matematika diskrit?',
                'file' => 'REPLY_MATEMATIKA DISKRIT_1674715332.pdf',
                'created_at' => '2023-01-26 13:42:12',
                'updated_at' => '2023-01-26 13:42:12'
            ]
        ]);

        DB::table('reply_forums')->insert([
            [
                'thread_id' => 1,
                'user_id' => 3,
                'body' => 'Menurut saya matematika diskrit adalah Matematika diskrit atau diskret adalah cabang matematika yang membahas segala sesuatu yang bersifat diskrit. Diskrit disini artinya tidak saling berhubungan (lawan dari kontinyu).   Objek yang dibahas dalam Matematika Diskrit – seperti bilangan bulat, graf, atau kalimat logika – tidak berubah secara kontinyu, namun memiliki nilai yang tertentu dan terpisah.

                Referensi:
                http://rizkimuliono.blog.uma.ac.id/matematika-diskrit/',
                'created_at' => '2023-01-26 13:48:02',
                'updated_at' => '2023-01-26 13:48:02'
            ]
        ]);
    }
}
