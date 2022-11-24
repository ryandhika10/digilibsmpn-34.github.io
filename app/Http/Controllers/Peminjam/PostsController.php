<?php

namespace App\Http\Controllers\Peminjam;

use afrizalmy\BWI\BadWord;
use App\Models\Tag;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Komentar;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = ' | Semua Postingan';
        $titlePost = '';
        $semuaKategori = Kategori::where('jenis_kategori_id', 3)->whereNot('nama', 'None')->orderBy('digunakan', 'desc')->limit(10)->get();

        if (request('kategori')) {
            $kategori = Kategori::firstWhere('slug', request('kategori'));
            $titlePost = ' di Kategori ' . $kategori->nama;
        }

        if (request('user')) {
            $user = User::firstWhere('username', request('user'));
            $titlePost = ' Oleh ' . $user->nama;
        }

        if (request('tag')) {
            $tag = Tag::firstWhere('slug', request('tag'));
            $titlePost = ' di Tag ' . $tag->nama;
        }

        return view('peminjam.blog.index', [
            "titlePost" => "Semua Postingan" . $titlePost,
            "title" => $title,
            "semuaKategori" => $semuaKategori,
            "posts" => Post::latest()->filter(request(['search', 'kategori', 'user', 'tag']))->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, Request $request)
    {
        $semuaKategori = Kategori::where('jenis_kategori_id', 3)->whereNot('nama', 'None')->latest()->get();
        $like = Like::where('post_id', $post->id)->count();
        $title = ' | Detail Post';
        $postPopuler = Post::orderBy('dilihat', 'desc')->limit(4)->get();

        if (!Auth::check()) { //guest user identified by ip
            $cookie_name = (Str::replace('.', '', ($request->ip())) . '-' . $post->id);
        } else {
            $cookie_name = (Auth::user()->id . '-' . $post->id); //logged in user
        }
        if (Cookie::get($cookie_name) == '') { //check if cookie is set
            $cookie = cookie($cookie_name, '1', 20); //set the cookie
            $post->increment('dilihat'); //count the view
            return response()
                ->view('peminjam.blog.show', compact('title', 'post', 'semuaKategori', 'like', 'postPopuler'))
                ->withCookie($cookie); //store the cookie
        } else {
            return  view('peminjam.blog.show', compact('title', 'post', 'semuaKategori', 'like', 'postPopuler')); //this view is not counted
        }
    }

    public function postKomentar(Request $request)
    {
        $request->request->add(['user_id' => auth()->user()->id]);
        $konten = BadWord::masking($request->konten);
        $komentar = Komentar::create([
            'post_id' => $request->post_id,
            'parent' => $request->parent,
            'user_id' => $request->user_id,
            'konten' => $konten,
        ]);

        $post = Post::whereId($request->post_id)->firstOrFail();
        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan');
    }
}
