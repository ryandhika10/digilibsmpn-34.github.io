<?php

namespace App\Http\Controllers\Peminjam;

use Carbon\Carbon;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Peminjaman;
use Illuminate\Support\Str;
use App\Models\TempatTerbit;
use Illuminate\Http\Request;
use App\Models\DetailPeminjaman;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

use function PHPUnit\Framework\isEmpty;

class BukuController extends Controller
{
    protected $count;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = ' | Semua Buku';
        $titleBuku = '';
        $this->count = DB::table('peminjaman')
            ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')
            ->where('peminjam_id', auth()->user()->id)
            ->where('status', '!=', 3)
            ->count();

        $semuaKategori = Kategori::where('jenis_kategori_id', 1)->whereNot('nama', 'None')->orderBy('digunakan', 'desc')->limit(10)->get();

        if (request('kategori')) {
            $kategori = Kategori::firstWhere('slug', request('kategori'));
            $titleBuku = ' di Kategori ' . $kategori->nama;
        }

        if (request('penerbit')) {
            $penerbit = Penerbit::firstWhere('slug', request('penerbit'));
            $titleBuku = ' Diterbitkan ' . $penerbit->nama;
        }

        if (request('tempat_terbit')) {
            $tempat_terbit = TempatTerbit::firstWhere('slug', request('tempat_terbit'));
            $titleBuku = ' di ' . $tempat_terbit->nama;
        }

        return view('peminjam/buku/index', [
            'title' => $title,
            'titleBuku' =>  "Semua Buku" . $titleBuku,
            'count' => $this->count,
            'semuaKategori' => $semuaKategori,
            'buku' => Buku::whereNot('stok', 0)->filter(request(['search', 'kategori', 'tempat_terbit', 'penerbit']))->paginate(12)->withQueryString()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku, Request $request)
    {
        $semuaKategori = Kategori::where('jenis_kategori_id', 1)->whereNot('nama', 'None')->latest()->get();
        $title = ' | Detail Buku';
        $bukuPopuler = Buku::orderBy('dilihat', 'desc')->limit(4)->get();

        if (!Auth::check()) { //guest user identified by ip
            $cookie_name = (Str::replace('.', '', ($request->ip())) . '-' . $buku->id);
        } else {
            $cookie_name = (Auth::user()->id . '-' . $buku->id); //logged in user
        }
        if (Cookie::get($cookie_name) == '') { //check if cookie is set
            $cookie = cookie($cookie_name, '1', 20); //set the cookie
            $buku->increment('dilihat'); //count the view
            return response()
                ->view('peminjam.buku.show', [
                    'title' => $title,
                    'buku' => $buku,
                    'semuaKategori' => $semuaKategori,
                    'bukuPopuler' => $bukuPopuler
                ])
                ->withCookie($cookie); //store the cookie
        } else {
            return  view('peminjam.buku.show', [
                'title' => $title,
                'buku' => $buku,
                'semuaKategori' => $semuaKategori,
                'bukuPopuler' => $bukuPopuler
            ]); //this view is not counted
        }
    }

    public function tambahBuku()
    {
        $this->count += 1;
    }

    public function kurangiBuku()
    {
        $this->count -= 1;
    }

    public function tambahKeranjang(Buku $buku)
    {
        // role siswa
        if (auth()->user()->hasRole(['siswa'])) {

            $peminjaman_lama = DB::table('peminjaman')
                ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')
                ->where('peminjam_id', auth()->user()->id)
                ->where('status', '!=', 3)
                ->get();

            // jumlah maksimal 2
            if ($peminjaman_lama->count() == 2) {

                return redirect()->back()->with('failed', 'Buku yang dipinjam maksimal 2');
            } else {

                // peminjaman belum ada isinya
                if ($peminjaman_lama->count() == 0) {
                    // Buku tidak bisa dipinjam jika stoknya 0
                    if ($buku->stok == 0) {
                        return redirect()->back()->with('failed', 'Buku dengan stok 0 tidak bisa dipinjam');
                    } else {
                        $peminjaman_baru = Peminjaman::create([
                            'kode_pinjam' => random_int(10000, 99999),
                            'peminjam_id' => auth()->user()->id,
                            'status' => 0
                        ]);

                        DetailPeminjaman::create([
                            'peminjaman_id' => $peminjaman_baru->id,
                            'buku_id' => $buku->id,
                        ]);

                        $this->tambahBuku();
                        return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke dalam keranjang');
                    }
                } else {
                    // Buku tidak bisa dipinjam jika stoknya 0
                    if ($buku->stok == 0) {
                        return redirect()->back()->with('failed', 'Buku dengan stok 0 tidak bisa dipinjam');
                    } else {
                        // buku tidak boleh sama
                        if ($peminjaman_lama[0]->buku_id == $buku->id) {
                            return redirect()->back()->with('failed', 'Buku tidak boleh sama');
                        } else {
                            // tidak bisa pinjam lagi jika suda ada tanggal pinjam
                            if (isset($peminjaman_lama[0]->tanggal_pinjam)) {
                                return redirect()->back()->with('failed', 'Tidak bisa pinjam buku karena tanggal pinjam sudah dibuat');
                            } else {
                                DetailPeminjaman::create([
                                    'peminjaman_id' => $peminjaman_lama[0]->peminjaman_id,
                                    'buku_id' => $buku->id,
                                ]);
                                $this->tambahBuku();
                                return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke dalam keranjang');
                            }
                        }
                    }
                }
            }
        } else {
            return redirect()->back()->with('failed', 'Role user anda bukan siswa');
        }
    }

    public function keranjang()
    {
        $keranjang = Peminjaman::latest()->where('peminjam_id', auth()->user()->id)->where('status', '!=', 3)->first();
        if ($keranjang == null) {
            return redirect('/buku');
        }
        $title = ' | Keranjang Buku';
        return view('peminjam.buku.keranjang', compact('keranjang', 'title'));
    }

    public function pinjam(Request $request)
    {
        $pinjam = Peminjaman::latest()->where('peminjam_id', auth()->user()->id)->where('status', '!=', 3)->first();

        $request->validate([
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
        ], [
            'tanggal_pinjam.after_or_equal' => 'Tanggal pinjam harus berisi tanggal setelah atau sama dengan tanggal hari ini'
        ]);

        $pinjam->update([
            'status' => 1,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => Carbon::create($request->tanggal_pinjam)->addDays(10),
        ]);
        return redirect()->back()->with('success', 'Buku berhasil dipinjam');
    }

    public function konfirmasi($id)
    {
        alert()->question('Peringatan !', 'Anda yakin akan menghapus data ?')
            ->showConfirmButton('<a href="/buku/keranjang/' . $id . '/delete" class="text-white" style="text-decoration: none"> Hapus</a>', '#3085d6')->toHtml()
            ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return redirect('/buku/keranjang');
    }

    public function delete($id)
    {
        $detail_peminjaman = DetailPeminjaman::whereId($id)->firstOrFail();
        $peminjaman = Peminjaman::whereId($detail_peminjaman->peminjaman_id)->get();
        foreach ($peminjaman as $item) {
            if ($item->detail_peminjaman->count() == 1) {
                $detail_peminjaman->delete();
                $item->delete();
                Alert::success('Sukses', 'Data berhasil dihapus');
                return redirect('/buku');
            } else {
                $detail_peminjaman->delete();
                $this->kurangiBuku();
                Alert::success('Sukses', 'Data berhasil dihapus');
                return redirect('/buku/keranjang');
            }
        }
    }
}
