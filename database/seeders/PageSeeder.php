<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    public function run()
    {
        $pages = [
            ['slug'=>'beranda','title'=>'Selamat Datang di ERTHREE','content'=>'<p>Selamat datang di ERTHREE Coffee and Space. Kami menyajikan kopi terbaik.</p>'],
            ['slug'=>'welcome','title'=>'Selamat Datang','content'=>'<p>Welcome to our coffee shop.</p>'],
            ['slug'=>'about','title'=>'Tentang Kami','content'=>'<h3>Tentang ERTHREE</h3><p>Brand ini bermula pada Agustus 2023...</p>'],
            ['slug'=>'deskripsi-singkat','title'=>'Deskripsi Singkat','content'=>'<p>ERTHREE adalah tempat kopi dan ruang kerja.</p>'],
            ['slug'=>'service','title'=>'Servis Kami','content'=>'<h3>Pelayanan Kami</h3><p>Kami menyediakan layanan terbaik termasuk delivery dan tempat kerja.</p>'],
            ['slug'=>'servis','title'=>'Servis','content'=>'<p>Versi lokal untuk servis.</p>'],
            ['slug'=>'reservation','title'=>'Reservasi','content'=>'<h3>Reservasi</h3><p>Isi formulir reservasi untuk memesan ruang.</p>'],
            ['slug'=>'reservasi','title'=>'Reservasi','content'=>'<p>Reservasi (ID).</p>'],
            ['slug'=>'contact','title'=>'Kontak Kami','content'=>'<h3>Kontak</h3><p>Email: erthreecoffee@gmail.com<br>Phone: +62 812-3341-8750</p>'],
            ['slug'=>'kontak','title'=>'Kontak','content'=>'<p>Kontak (ID).</p>'],
        ];

        foreach ($pages as $p) {
            DB::table('pages')->updateOrInsert(
                ['slug'=>$p['slug']],
                ['title'=>$p['title'],'content'=>$p['content'],'updated_at'=>now(),'created_at'=>now()]
            );
        }
    }
}
