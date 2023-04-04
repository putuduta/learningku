<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ReplyForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reply_forums')->insert([
            [
                'forum_id' => '1',
                'user_id' => '34',
                'body' => '<p><strong>Struktur </strong><i><strong>Personal Letter</strong></i></p><ol><li><i>Address</i></li><li><i>Date</i></li><li><i>Salutation</i></li><li><i>Introduction</i></li><li><i>&nbsp;Body</i></li><li><i>Closing</i></li><li><i>Complimentary close</i></li><li><i>Signature</i></li></ol>',
                'created_at' => '2023-04-04 14:58:10',
                'updated_at' => '2023-04-04 14:58:10'
            ],
            [
                'forum_id' => '1',
                'user_id' => '33',
                'body' => '<p>Stuktur Penulisan Personal Letter,</p><ol><li><i><strong>Opening</strong></i>, berisi alamat, tanggal, dan sapaan (<i>Dear</i>. <i>Receiver’s name</i>).</li><li><i><strong>Body of letter</strong></i>, berisi pembukaan, isi, dan kesimpulan.</li><li><i><strong>Closing</strong></i>, berisi <i>valediction </i>(<i>sincerely, best regards, with love, etc.</i>), tanda tangan, dan nama pengirim surat</li></ol>',
                'created_at' => '2023-04-04 15:58:10',
                'updated_at' => '2023-04-04 15:58:10'
            ],
            [
                'forum_id' => '1',
                'user_id' => '31',
                'body' => '<p><strong>Struktur </strong><i><strong>Personal Letter</strong></i></p><p><i><strong>1. Date </strong></i><strong>(Tanggal)</strong></p><p>Biasanya bagian paling pertama dari sebuah surat adalah tanggal saat surat itu dituliskan. Tanggal dapat ditulis di bagian atas kanan maupun kiri.</p><p>2. <i><strong>Address </strong></i><strong>(Alamat)</strong></p><p>Alamat pengirim di<i> personal letter</i> biasanya dituliskan di bagian kanan atas. Sementara itu alamat penerima tertulis di bagian kiri atas.</p><p>3. <i><strong>Greeting </strong></i><strong>(Salam Pembuka)</strong></p><p>Salam pembuka memiliki beragam variasi. Mengingat sifatnya personal, maka salam tersebut tidak perlu terlalu baku. Misalnya <i>Dear</i>, <i>Hi</i>, atau <i>Hallo</i>.</p><p>4. <i><strong>Introduction</strong></i><strong> (Perkenalan)</strong></p><p>Bagian ini merupakan pembuka yang berisi komentar atas surat sebelumnya maupun menyampaikan maksud surat ini ditulis.</p><p>5. <i><strong>Body</strong></i> (Isi)</p><p>Bagian ini merupakan yang paling penting, karena berisi inti surat.</p><p>6. <i><strong>Closing</strong></i><strong> (Penutup)</strong></p><p>Selanjutnya kamu bisa menambahkan kalimat penutup untuk mengakhiri surat. Kamu bisa menambahkan harapan, misalnya berharap akan memperoleh surat balasan.</p><p>7. <i><strong>Greeting for Closing</strong></i><strong> (Salam Penutup)</strong></p><p>Salam penutup untuk surat pribadi bisa beragam, misalnya Best regards, Truly yours, dan lain-lain.</p><p>8. <i><strong>Signature</strong></i><strong> (Tanda Tangan)</strong></p><p>Setelah menutup surat, jangan lupa untuk membubuhkan tanda tangan dan nama terang.</p><p>Referensi: <a href="https://lister.co.id/blog/apa-itu-personal-letter-ini-dia-pengertian-dan-strukturnya/">Personal Letter Adalah: Struktur, Tema, Dan Contoh - Lister.co.id</a></p>',
                'created_at' => '2023-04-04 16:58:10',
                'updated_at' => '2023-04-04 16:58:10'
            ],
            [
                'forum_id' => '1',
                'user_id' => '30',
                'body' => '<p>Struktur Personal Letter</p><ol><li>Address (Alamat), dalam personal letter, address atau alamat adalah bagian opsional.</li><li>Date (Tanggal), selain alamat, tanggal juga merupakan bagian opsional dalam personal letter. Tanggal ditulis di bawah alamat penerima, lebih tepatnya di bagian sisi kiri.</li><li>Greeting (Salam pembuka), greeting atau salutation merupakan salam pembuka yang tidak terlalu baku dalam personal letter, misalnya Dear, Hi, atau Hello, kemudian diikuti dengan nama si penerima.</li><li>Introduction (Pembukaan), sesuai namanya, introduction merupakan pembukaan di awal surat yang dapat ditulis dengan menanyakan kabar atau tanggapan atas surat sebelumnya jika Anda sedang menulis surat balasan.</li><li>Body (Isi), di sinilah Anda menulis maksud Anda menulis surat pribadi.</li><li>Closing (Penutup), untuk mengakhiri surat, Anda bisa menambahkan penutup untuk mengakhiri surat, misalnya dengan menuliskan harapan agar surat tersebut mendapatkan balasan.</li><li>Complimentary close (Salam penutup), setelah mengakhiri surat dengan beberapa kalimat, Anda bisa menuliskan salam penutup yang ditujukan kepada penerima surat.</li></ol><p>Referensi: <a href="https://www.superprof.co.id/blog/gambaran-umum-personal-letter/">Apa Itu Personal Letter Dan Bagaimana Contohnya? (superprof.co.id)</a></p>',
                'created_at' => '2023-04-04 17:00:10',
                'updated_at' => '2023-04-04 17:00:10'
            ],
        ]);
    }
}
