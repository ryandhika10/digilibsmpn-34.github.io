<?php

namespace App\Http\Livewire\Peminjam;

use Livewire\Component;
use App\Models\Kategori;
use Livewire\WithPagination;
use App\Models\Buku as ModelsBuku;
use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

class Buku extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $kategori_id, $pilih_kategori, $buku_id, $detail_buku;
    public $search, $count;
    public $paginate = 8;

    protected $queryString = ['search'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);

        if (auth()->user()) {
            $this->count = DB::table('peminjaman')
                ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')
                ->where('peminjam_id', auth()->user()->id)
                ->where('status', '!=', 3)
                ->count();
        }
    }

    public function tambahKeranjang()
    {
        $this->count += 1;
    }

    public function kurangiKeranjang()
    {
        $this->count -= 1;
    }

    public function pilihKategori($id)
    {
        $this->format();
        $this->kategori_id = $id;
        $this->pilih_kategori = true;
        $this->updatingSearch();
    }

    public function semuaKategori()
    {
        $this->format();
        $this->pilih_kategori = false;
        $this->updatingSearch();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function detailBuku($id)
    {
        $this->format();
        $this->buku_id = $id;
        $this->detail_buku = true;
    }

    public function kembali()
    {
        $this->format();
    }

    public function keranjang(ModelsBuku $buku)
    {
        // user harus login
        if (auth()->user()) {

            // role peminjam
            if (auth()->user()->hasRole('siswa')) {

                $peminjaman_lama = DB::table('peminjaman')
                    ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')
                    ->where('peminjam_id', auth()->user()->id)
                    ->where('status', '!=', 3)
                    ->get();

                // jumlah maksimal 2
                if ($peminjaman_lama->count() == 2) {

                    session()->flash('gagal', 'Buku yang dipinjam maksimal 2');
                } else {

                    // peminjaman belum ada isinya
                    if ($peminjaman_lama->count() == 0) {
                        $peminjaman_baru = Peminjaman::create([
                            'kode_pinjam' => random_int(100000000, 999999999),
                            'peminjam_id' => auth()->user()->id,
                            'status' => 0
                        ]);

                        DetailPeminjaman::create([
                            'peminjaman_id' => $peminjaman_baru->id,
                            'buku_id' => $buku->id,
                        ]);

                        $this->tambahKeranjang();
                        session()->flash('sukses', 'Buku berhasil ditambahkan ke dalam keranjang');
                    } else {

                        // buku tidak boleh sama
                        if ($peminjaman_lama[0]->buku_id == $buku->id) {
                            session()->flash('gagal', 'Buku tidak boleh sama');
                        } else {

                            DetailPeminjaman::create([
                                'peminjaman_id' => $peminjaman_lama[0]->peminjaman_id,
                                'buku_id' => $buku->id,
                            ]);

                            $this->tambahKeranjang();
                            session()->flash('sukses', 'Buku berhasil ditambahkan ke dalam keranjang');
                        }
                    }
                }
            } else {
                session()->flash('gagal', 'Role user anda bukan siswa');
            }
        } else {
            session()->flash('gagal', 'Anda harus login terlebih dahulu');
            redirect('/login');
        }
    }

    public function render()
    {
        if ($this->pilih_kategori) {
            if ($this->search) {
                $buku = ModelsBuku::latest()->where('judul', 'like', '%' . $this->search . '%')->where('kategori_id', $this->kategori_id)->paginate($this->paginate);
            } else {
                $buku = ModelsBuku::latest()->where('kategori_id', $this->kategori_id)->paginate($this->paginate);
            }
            $kategori = Kategori::where('id', '!=', 1)->get();
            $count = $this->count;
            $title = Kategori::find($this->kategori_id)->nama;
        } elseif ($this->detail_buku) {
            $buku = ModelsBuku::find($this->buku_id);
            $title = 'Detail Buku';
            $kategori = Kategori::where('id', '!=', 1)->get();
            $count = $this->count;
        } else {
            if ($this->search) {
                $buku = ModelsBuku::latest()->where('judul', 'like', '%' . $this->search . '%')->paginate($this->paginate);
            } else {
                $buku = ModelsBuku::latest()->paginate($this->paginate);
            }
            $title = "Semua Buku";
            $kategori = Kategori::where('id', '!=', 1)->get();
            $count = $this->count;
        }
        return view('livewire.peminjam.buku', compact('buku', 'title', 'kategori', 'count'));
    }

    public function format()
    {
        unset($this->kategori_id);
        $this->pilih_kategori = false;
        unset($this->buku_id);
        $this->detail_buku = false;
    }
}
