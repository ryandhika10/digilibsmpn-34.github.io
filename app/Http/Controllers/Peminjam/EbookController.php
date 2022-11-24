<?php

namespace App\Http\Controllers\Peminjam;

use App\Models\Like;
use App\Models\Ebook;
use App\Models\Kategori;
use App\Models\Penerbit;
use Illuminate\Support\Str;
use App\Models\TempatTerbit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class EbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = ' | Semua E-Book';
        $titleEbook = '';

        $semuaKategori = Kategori::where('jenis_kategori_id', 2)->whereNot('nama', 'None')->orderBy('digunakan', 'desc')->limit(10)->get();

        if (request('kategori')) {
            $kategori = Kategori::firstWhere('slug', request('kategori'));
            $titleEbook = ' di Kategori ' . $kategori->nama;
        }

        if (request('penerbit')) {
            $penerbit = Penerbit::firstWhere('slug', request('penerbit'));
            $titleEbook = ' Diterbitkan ' . $penerbit->nama;
        }

        if (request('tempat_terbit')) {
            $tempat_terbit = TempatTerbit::firstWhere('slug', request('tempat_terbit'));
            $titleEbook = ' di ' . $tempat_terbit->nama;
        }

        return view('peminjam/ebook/index', [
            'title' => $title,
            'titleEbook' =>  "Semua E-book" . $titleEbook,
            'semuaKategori' => $semuaKategori,
            'ebook' => Ebook::whereNot('file', null)->filter(request(['search', 'kategori', 'tempat_terbit', 'penerbit']))->paginate(12)->withQueryString()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ebook $ebook, Request $request)
    {
        $semuaKategori = Kategori::where('jenis_kategori_id', 2)->whereNot('nama', 'None')->latest()->get();
        $title = ' | Detail E-book';
        $ebookPopuler = Ebook::orderBy('dilihat', 'desc')->limit(4)->get();

        if (!Auth::check()) { //guest user identified by ip
            $cookie_name = (Str::replace('.', '', ($request->ip())) . '-' . $ebook->id);
        } else {
            $cookie_name = (Auth::user()->id . '-' . $ebook->id); //logged in user
        }
        if (Cookie::get($cookie_name) == '') { //check if cookie is set
            $cookie = cookie($cookie_name, '1', 20); //set the cookie
            $ebook->increment('dilihat'); //count the view
            return response()
                ->view('peminjam.ebook.show', [
                    'title' => $title,
                    'ebook' => $ebook,
                    'semuaKategori' => $semuaKategori,
                    'ebookPopuler' => $ebookPopuler,
                ])
                ->withCookie($cookie); //store the cookie
        } else {
            return  view('peminjam.ebook.show', [
                'title' => $title,
                'ebook' => $ebook,
                'semuaKategori' => $semuaKategori,
                'ebookPopuler' => $ebookPopuler
            ]); //this view is not counted
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
