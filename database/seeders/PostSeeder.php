<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Post;
use App\Models\Rekomendasi;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // post 1
        $post = Post::create([
            'kategori_id' => 10,
            'user_id' => 6,
            'sampul' => 'post/pengenalan diri.jpeg',
            'judul' => 'Pengenalan Diri Penulis',
            'konten' => 'Haii.. Namaku Ryan Dhika Permana, biasa dipanggil Ryan, Dhika atau Enang. Kenapa Enang? Karena sejak kecil saya lahir di Jakarta 10 Januari 2000, sekarang saya berumur 22 tahun. Ketika SMP, saya bersekolah di SMP Negeri 34 Jakarta, saat itu sekolah tersebut masih dalam pembangunan. Ketika itu saya melihat perpustakaan masih belum tertata rapi dan banyak perbaikan disana sini. Namun selama 3 tahun saya bersekolah disana, perpustakaan semakin hari semakin bagus dan nyaman untuk digunakan siswa-siswi pada saat itu. Namun, hal yang kurang lengkap menurut saya adalah kurangnya sistem atau aplikasi dalam memudahkan siswa-siswi melakukan peminjaman buku, oleh karena itu saya sebagai alumni SMP Negeri 34 membuat aplikasi yang digunakan untuk memudahkan siswa-siswi dalam melakukan kegiatan peminjaman buku dan lebihnya lagi aplikasi yang saya buat diharapkan dapat meningkatkan kreativitas siswa-siswi dalam menulis',
            'kutipan' => Str::limit(strip_tags('Haii.. Namaku Ryan Dhika Permana, biasa dipanggil Ryan, Dhika atau Enang. Kenapa Enang? Karena sejak kecil saya lahir di Jakarta 10 Januari 2000, sekarang saya berumur 22 tahun. Ketika SMP, saya bersekolah di SMP Negeri 34 Jakarta, saat itu sekolah tersebut masih dalam pembangunan. Ketika itu saya melihat perpustakaan masih belum tertata rapi dan banyak perbaikan disana sini. Namun selama 3 tahun saya bersekolah disana, perpustakaan semakin hari semakin bagus dan nyaman untuk digunakan siswa-siswi pada saat itu. Namun, hal yang kurang lengkap menurut saya adalah kurangnya sistem atau aplikasi dalam memudahkan siswa-siswi melakukan peminjaman buku, oleh karena itu saya sebagai alumni SMP Negeri 34 membuat aplikasi yang digunakan untuk memudahkan siswa-siswi dalam melakukan kegiatan peminjaman buku dan lebihnya lagi aplikasi yang saya buat diharapkan dapat meningkatkan kreativitas siswa-siswi dalam menulis'), 200),
            'slug' => Str::slug('Pengenalan Diri Penulis'),
            'dilihat' => 0
        ]);

        $post->kategori->increment('digunakan');

        DB::table('post_tag')->insert([
            'post_id' => $post->id,
            'tag_id' => 4,
        ]);

        Like::create([
            'post_id' => $post->id,
            'user_id' => 7,
        ]);

        // post 2
        $post = Post::create([
            'kategori_id' => 9,
            'user_id' => 7,
            'sampul' => 'post/alam.jpg',
            'judul' => 'Pemandangan Alam Di Kampung Halaman',
            'konten' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores, quasi cupiditate accusantium tempora laborum est ad aut odit saepe corrupti facere veritatis, beatae perferendis. Quo ea repellendus in maiores nam?',
            'kutipan' => Str::limit(strip_tags('Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores, quasi cupiditate accusantium tempora laborum est ad aut odit saepe corrupti facere veritatis, beatae perferendis. Quo ea repellendus in maiores nam?'), 200),
            'slug' => Str::slug('Pemandangan Alam Di Kampung Halaman'),
            'dilihat' => 0
        ]);

        $post->kategori->increment('digunakan');

        DB::table('post_tag')->insert([
            'post_id' => $post->id,
            'tag_id' => 5,
        ]);

        DB::table('post_tag')->insert([
            'post_id' => $post->id,
            'tag_id' => 6,
        ]);

        Like::create([
            'post_id' => $post->id,
            'user_id' => 6,
        ]);

        Like::create([
            'post_id' => $post->id,
            'user_id' => 4
        ]);

        Rekomendasi::create([
            'post_id' => $post->id
        ]);

        // post 3
        $post = Post::create([
            'kategori_id' => 8,
            'user_id' => 4,
            'sampul' => 'post/matematika.jpg',
            'judul' => 'Rumus Matematika yang Harus Kamu Ketahui',
            'konten' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores, quasi cupiditate accusantium tempora laborum est ad aut odit saepe corrupti facere veritatis, beatae perferendis. Quo ea repellendus in maiores nam?',
            'kutipan' => Str::limit(strip_tags('Asperiores, quasi cupiditate accusantium tempora laborum est ad aut odit saepe corrupti facere veritatis, beatae perferendis. Quo ea repellendus in maiores nam?'), 200),
            'slug' => Str::slug('Rumus Matematika yang Harus Kamu Ketahui'),
            'dilihat' => 0
        ]);

        $post->kategori->increment('digunakan');

        DB::table('post_tag')->insert([
            'post_id' => $post->id,
            'tag_id' => 2,
        ]);

        Rekomendasi::create([
            'post_id' => $post->id
        ]);

        // post 4
        $post = Post::create([
            'kategori_id' => 8,
            'user_id' => 5,
            'sampul' => 'post/bahasa.jpg',
            'judul' => 'Penulisan Bahasa Indonesia yang sesuai dengan EYD',
            'konten' => 'Dui accumsan sit amet nulla facilisi morbi tempus iaculis urna. Adipiscing commodo elit at imperdiet dui accumsan sit amet. Lacus sed viverra tellus in hac habitasse platea. Tempor commodo ullamcorper a lacus. Placerat in egestas erat imperdiet sed euismod nisi porta lorem. Non odio euismod lacinia at. Neque ornare aenean euismod elementum. Sit amet porttitor eget dolor morbi. Lobortis mattis aliquam faucibus purus in massa tempor nec feugiat.',
            'kutipan' => Str::limit(strip_tags('Dui accumsan sit amet nulla facilisi morbi tempus iaculis urna. Adipiscing commodo elit at imperdiet dui accumsan sit amet. Lacus sed viverra tellus in hac habitasse platea. Tempor commodo ullamcorper a lacus. Placerat in egestas erat imperdiet sed euismod nisi porta lorem. Non odio euismod lacinia at. Neque ornare aenean euismod elementum. Sit amet porttitor eget dolor morbi. Lobortis mattis aliquam faucibus purus in massa tempor nec feugiat.'), 200),
            'slug' => Str::slug('Penulisan Bahasa Indonesia yang sesuai dengan EYD'),
            'dilihat' => 0
        ]);

        $post->kategori->increment('digunakan');

        DB::table('post_tag')->insert([
            'post_id' => $post->id,
            'tag_id' => 1,
        ]);

        Like::create([
            'post_id' => $post->id,
            'user_id' => 4,
        ]);
    }
}
