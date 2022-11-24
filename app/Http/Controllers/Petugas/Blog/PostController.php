<?php

namespace App\Http\Controllers\Petugas\Blog;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Kategori;
use App\Models\Komentar;
use App\Models\Rekomendasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Rules\Badwords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $search = '';
        $session = '';
        if (request()->search) {
            $post = Post::select('id', 'judul', 'slug', 'sampul', 'kategori_id')->where('user_id', Auth::user()->id)->where('judul', 'like', '%' . request()->search . '%')->latest()->paginate(10);
            $search = request()->search;
            if (count($post) == 0) {
                $session = session('sukses', 'Data yang anda cari tidak ada');
            }
        } else {
            $post = Post::select('id', 'judul', 'slug', 'sampul', 'kategori_id')->where('user_id', Auth::user()->id)->latest()->paginate(10);
        }

        return view('petugas/data-blog/post/index', compact('post', 'search', 'session'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tag = Tag::select('id', 'nama')->get();
        $kategori = Kategori::select('id', 'nama')->where('jenis_kategori_id', 3)->get();

        return view('petugas/data-blog/post/create', compact('kategori', 'tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => ['required', 'unique:post,judul', 'min:3', 'max:60', new Badwords],
            'slug' => 'required|unique:post|min:3|max:60',
            'tag' => 'required|array|max:3',
            'sampul' => 'required|image|mimes:jpg,jpeg,png|max:3072',
            'konten' => ['required', new Badwords],
            'kategori' => 'required',
        ]);

        $namaSampul = time() . '-' . $request->sampul->getClientOriginalName();
        $sampul = $request->sampul->storeAs('post', $namaSampul, 'public');

        Post::create([
            'sampul' => $sampul,
            'judul' => $request->judul,
            'konten' => $request->konten,
            'kutipan' => Str::limit(strip_tags($request->konten), 200),
            'kategori_id' => $request->kategori,
            'dilihat' => 0,
            'slug' => Str::slug($request->judul, '-'),
            'user_id' => Auth::user()->id,
        ])->tag()->attach($request->tag);

        $tambahDigunakan = Kategori::where('id', $request->kategori)->firstOrFail();
        $tambahDigunakan->increment('digunakan');

        Alert::success('Sukses', 'Data berhasil ditambahkan');
        return redirect('/d-blog');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('user_id', Auth::user()->id)->where('slug', $slug)->firstOrFail();

        return view('petugas/data-blog/post/show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $tag = Tag::select('id', 'nama')->get();
        $kategori = Kategori::select('id', 'nama')->where('jenis_kategori_id', 3)->get();
        $post = Post::where('user_id', Auth::user()->id)->where('slug', $slug)->firstOrFail();

        return view('petugas/data-blog/post/edit', compact('post', 'kategori', 'tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $validasi = [
            'judul' => ['required', 'min:3', 'max:60', new Badwords],
            'tag' => 'required|array|max:3',
            'sampul' => 'image|mimes:jpg,jpeg,png|max:3072',
            'konten' => ['required', 'min:3', new Badwords],
            'kategori_id' => 'required',
        ];
        if ($request->slug != $post->slug) {
            $validasi['slug'] = 'required|unique:post|max:60|min:3';
        }

        $validatedData = $request->validate($validasi);
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['kutipan'] = Str::limit(strip_tags($request->konten), 200);

        if ($request->sampul) {
            Storage::disk('public')->delete($post->sampul);

            $namaSampul = time() . '-' . $request->sampul->getClientOriginalName();
            $sampul = $request->sampul->storeAs('post', $namaSampul, 'public');

            $validatedData['sampul'] = $sampul;
        }

        if ($request->kategori_id != $post->kategori_id) {
            $post->kategori->decrement('digunakan');
        }

        $post->update($validatedData);
        $post->tag()->sync($request->tag);
        $post->kategori->increment('digunakan');

        Alert::success('Sukses', 'Data berhasil diubah');
        return redirect('/d-blog');
    }

    public function konfirmasi($id)
    {
        alert()->question('Peringatan !', 'Anda yakin akan menghapus data ?')
            ->showConfirmButton('<a href="/d-blog/' . $id . '/delete" class="text-white" style="text-decoration: none"> Hapus</a>', '#3085d6')->toHtml()
            ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return redirect('/d-blog');
    }

    public function delete($id)
    {
        $post = Post::select('sampul', 'id', 'kategori_id')->whereId($id)->where('user_id', Auth::user()->id)->firstOrFail();
        Storage::disk('public')->delete($post->sampul);
        $post->kategori->decrement('digunakan');
        $post->delete();
        Alert::success('Sukses', 'Data berhasil dihapus');
        return redirect('/d-blog');
    }

    public function rekomendasi($id)
    {
        $post = DB::table('post')
            ->join('rekomendasi', 'post.id', '=', 'rekomendasi.post_id')
            ->where('rekomendasi.post_id', $id)
            ->get();

        if ($post->isEmpty()) {
            Rekomendasi::create([
                'post_id' => $id,
            ]);

            Alert::success('Sukses', 'Post berhasil direkomendasikan');
            return redirect('/d-blog');
        } else {
            Rekomendasi::where('post_id', $id)->delete();
            Alert::success('Sukses', 'Post batal direkomendasikan');
            return redirect('/d-blog');
        }
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->judul);
        return response()->json(['slug' => $slug]);
    }
}
