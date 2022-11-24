<?php

namespace App\Http\Controllers\Peminjam;

use App\Models\Post;
use App\Models\Rekomendasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::select('dilihat')->get();
        $rekomendasi = Rekomendasi::select('post_id')->latest()->paginate(7);
        $title = '';
        return view('peminjam/beranda/index', compact('title', 'rekomendasi'));
    }
}
