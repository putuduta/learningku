<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ForumSeeder extends Seeder
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
                'class_subject_id' => '1',
                'user_id' => '2',
                'title' => 'Personal Letter',
                'body' => '<p><strong>Pengertian Personal Letter</strong><br>Surat dalam bahasa Inggris disebut dengan Letter. Personal Letter merupakan surat tidak resmi yang ditulis untuk perseorangan, biasanya yang terlibat hanyalah dua orang yang saling mengenal.</p><p>Menurut kalian , apa saja struktur dari personal letter?</p>',
                'created_at' => '2023-04-04 13:58:10',
                'updated_at' => '2023-04-04 13:58:10'
            ]
        ]);
    }
}
