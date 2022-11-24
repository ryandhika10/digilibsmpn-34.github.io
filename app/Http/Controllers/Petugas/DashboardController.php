<?php

namespace App\Http\Controllers\Petugas;

use App\Models\Tag;
use App\Models\Buku;
use App\Models\Post;
use App\Models\User;
use App\Models\Ebook;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // count
        $count_buku = Buku::count();
        $count_ebook = Ebook::count();
        $count_siswa = User::role('siswa')->count();
        $count_guru = User::role('guru')->count();
        $count_post = Post::where('user_id', auth()->user()->id)->count();
        $count_kategori = Kategori::where('jenis_kategori_id', 3)->whereNot('nama', 'None')->count();
        $count_tag = Tag::count();
        $count_sedang_dipinjam = Peminjaman::where('status', 2)->count();
        $count_selesai_dipinjam = Peminjaman::where('status', 3)->count();

        // terbaru
        $buku = Buku::limit(5)->latest()->get();
        $ebook = Ebook::limit(5)->latest()->get();
        $guru = User::role('guru')->limit(5)->latest()->get();
        $kategori = Kategori::where('jenis_kategori_id', 3)->whereNot('nama', 'None')->limit(5)->orderBy('digunakan', 'desc')->get();
        $tag = Tag::select('nama', 'slug')->limit(5)->latest()->get();
        $post = Post::where('user_id', auth()->user()->id)->limit(5)->latest()->get();
        $siswa = User::role('siswa')->limit(5)->latest()->get();
        $sedang_dipinjam = Peminjaman::where('status', 2)->limit(5)->latest()->get();
        $selesai_dipinjam = Peminjaman::where('status', 3)->limit(5)->latest()->get();

        return view('petugas/dashboard/index', compact(
            'count_buku',
            'count_ebook',
            'count_siswa',
            'count_guru',
            'count_post',
            'count_kategori',
            'count_tag',
            'count_sedang_dipinjam',
            'count_selesai_dipinjam',
            'buku',
            'ebook',
            'guru',
            'kategori',
            'tag',
            'post',
            'siswa',
            'sedang_dipinjam',
            'selesai_dipinjam'
        ));
    }
}
