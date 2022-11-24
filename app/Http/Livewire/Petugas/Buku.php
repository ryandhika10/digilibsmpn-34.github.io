<?php

namespace App\Http\Livewire\Petugas;

use App\Models\Rak;
use Livewire\Component;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Exports\BukuExport;
use App\Imports\BukuImport;
use Illuminate\Support\Str;
use App\Models\TempatTerbit;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Buku as ModelsBuku;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class Buku extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['konfirmasiHapus' => 'destroy'];

    public $create, $show, $edit, $import;
    public $kategori, $rak, $penerbit, $tempat_terbit;
    public $kategori_id, $rak_id, $penerbit_id, $buku_id, $tempat_terbit_id;
    public $judul, $stok, $penulis, $tahun_terbit, $sampul, $baris;
    public $importExcel;
    public $search;

    protected $rules = [
        'judul' => 'required|unique:buku,judul|min:3|max:100',
        'penulis' => 'required|min:3|max:60',
        'tahun_terbit' => 'required|numeric|digits:4|min:1800|max:2100',
        'stok' => 'required|numeric|min:1',
        'sampul' => 'required|image|mimes:jpg,jpeg,png|max:3072',
        'kategori_id' => 'required|numeric|min:1',
        'rak_id' => 'required|numeric|min:1',
        'penerbit_id' => 'required|numeric|min:1',
        'tempat_terbit_id' => 'required|numeric|min:1',
    ];

    protected $validationAttributes = [
        'kategori_id' => 'kategori',
        'rak_id' => 'rak',
        'penerbit_id' => 'penerbit',
        'tempat_terbit_id' => 'tempat terbit',
    ];

    public function pilihKategori()
    {
        $this->rak = Rak::where('kategori_id', $this->kategori_id)->get();
    }

    public function import()
    {
        $this->format();
        $this->import = true;
    }

    public function exampleTemplate()
    {
        $filename = 'panduan-import-buku.zip';
        $path = public_path('file/' . $filename);

        return response()->download($path, $filename, [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment; filename=$filename'
        ]);
    }

    public function simpanImport()
    {
        $this->validate([
            'importExcel' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new BukuImport, $this->importExcel);
        $this->emit('success', ['pesan' => 'Data berhasil diimpor']);
        $this->format();
    }

    public function export()
    {

        $this->format();
        return Excel::download(new BukuExport, 'Perpustakaan SMPN 34 Jakarta-Data Buku.xlsx');
    }

    public function create()
    {
        $this->format();
        $this->create = true;
        $this->kategori = Kategori::where('jenis_kategori_id', 1)->get();
        $this->penerbit = Penerbit::all();
        $this->tempat_terbit = TempatTerbit::all();
    }


    public function store()
    {
        $this->validate();

        $namaSampul = time() . '-' . $this->sampul->getClientOriginalName();
        $this->sampul = $this->sampul->storeAs('buku', $namaSampul, 'public');

        ModelsBuku::create([
            'sampul' => $this->sampul,
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'tahun_terbit' => $this->tahun_terbit,
            'stok' => $this->stok,
            'dilihat' => 0,
            'kategori_id' => $this->kategori_id,
            'rak_id' => $this->rak_id,
            'penerbit_id' => $this->penerbit_id,
            'tempat_terbit_id' => $this->tempat_terbit_id,
            'slug' => Str::slug($this->judul)
        ]);

        $tambahDigunakan = Kategori::where('id', $this->kategori_id)->firstOrFail();
        $tambahDigunakan->increment('digunakan');

        $this->emit('success', ['pesan' => 'Data berhasil ditambahkan']);

        $this->format();
    }

    public function show(ModelsBuku $buku)
    {
        $this->format();
        $this->show = true;
        $this->judul = $buku->judul;
        $this->sampul = $buku->sampul;
        $this->penulis = $buku->penulis;
        $this->tahun_terbit = $buku->tahun_terbit;
        $this->stok = $buku->stok;
        $this->kategori = $buku->kategori->nama;
        $this->penerbit = $buku->penerbit->nama;
        $this->tempat_terbit = $buku->tempat_terbit->nama;
        $this->rak = $buku->rak->rak;
        $this->baris = $buku->rak->baris;
    }

    public function edit(ModelsBuku $buku)
    {
        $this->format();

        $this->edit = true;
        $this->buku_id = $buku->id;
        $this->judul = $buku->judul;
        $this->penulis = $buku->penulis;
        $this->tahun_terbit = $buku->tahun_terbit;
        $this->stok = $buku->stok;
        $this->kategori_id = $buku->kategori_id;
        $this->rak_id = $buku->rak_id;
        $this->penerbit_id = $buku->penerbit_id;
        $this->tempat_terbit_id = $buku->tempat_terbit_id;
        $this->kategori = Kategori::where('jenis_kategori_id', 1)->get();
        $this->rak = Rak::where('kategori_id', $buku->kategori_id)->get();
        $this->penerbit = Penerbit::all();
        $this->tempat_terbit = TempatTerbit::all();
    }

    public function update(ModelsBuku $buku)
    {
        $validasi = [
            'penulis' => 'required|min:3|max:60',
            'tahun_terbit' => 'required|numeric|digits:4',
            'stok' => 'required|numeric|min:1',
            'kategori_id' => 'required|numeric|min:1',
            'rak_id' => 'required|numeric|min:1',
            'penerbit_id' => 'required|numeric|min:1',
            'tempat_terbit_id' => 'required|numeric|min:1',
        ];

        if ($this->judul != $buku->judul) {
            $validasi['judul'] = 'required|unique:buku|min:3|max:100';
        }

        if ($this->sampul) {
            $validasi['sampul'] = 'required|image|mimes:jpg,jpeg,png|max:3072';
        }

        $this->validate($validasi);

        if ($this->sampul) {
            if ($buku->sampul != 'buku/tidak_ada_sampul.png') {
                Storage::disk('public')->delete($buku->sampul);
            }
            $namaSampul = time() . '-' . $this->sampul->getClientOriginalName();
            $this->sampul = $this->sampul->storeAs('buku', $namaSampul, 'public');
        } else {
            $this->sampul = $buku->sampul;
        }

        if ($this->kategori_id != $buku->kategori_id) {
            $buku->kategori->decrement('digunakan');
        }

        $buku->update([
            'sampul' => $this->sampul,
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'tahun_terbit' => $this->tahun_terbit,
            'stok' => $this->stok,
            'kategori_id' => $this->kategori_id,
            'rak_id' => $this->rak_id,
            'penerbit_id' => $this->penerbit_id,
            'tempat_terbit_id' => $this->tempat_terbit_id,
            'slug' => Str::slug($this->judul)
        ]);

        $buku->kategori->increment('digunakan');

        $this->emit('success', ['pesan' => 'Data berhasil diubah']);

        $this->format();
    }

    public function deleteConfirmation($id)
    {
        $this->format();

        $this->buku_id = $id;
        $this->dispatchBrowserEvent('show-konfirmasi-hapus');
    }

    public function destroy()
    {
        $buku = ModelsBuku::where('id', $this->buku_id)->first();
        if ($buku->sampul != 'buku/tidak_ada_sampul.png') {
            Storage::disk('public')->delete($buku->sampul);
        }
        $buku->kategori->decrement('digunakan');

        $buku->delete();

        $this->emit('success', ['pesan' => 'Data berhasil dihapus']);

        $this->format();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        sleep(0.5);
        if ($this->search) {
            $buku = ModelsBuku::where('judul', 'like', '%' . $this->search . '%')->paginate(10);
        } else {
            $buku = ModelsBuku::paginate(10);
        }

        return view('livewire.petugas.buku', compact('buku'));
    }
    public function format()
    {
        unset($this->create);
        unset($this->show);
        unset($this->edit);
        unset($this->kategori);
        unset($this->rak);
        unset($this->import);
        unset($this->importExcel);
        unset($this->penerbit);
        unset($this->tahun_terbit);
        unset($this->tempat_terbit);
        unset($this->kategori_id);
        unset($this->rak_id);
        unset($this->penerbit_id);
        unset($this->tempat_terbit_id);
        unset($this->buku_id);
        unset($this->judul);
        unset($this->stok);
        unset($this->penulis);
        unset($this->sampul);
        unset($this->baris);
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
