<?php

namespace App\Http\Livewire\Petugas;

use Livewire\Component;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Exports\EbookExport;
use App\Imports\EbookImport;
use Illuminate\Support\Str;
use App\Models\TempatTerbit;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Ebook as ModelsEbook;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class Ebook extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['konfirmasiHapus' => 'destroy'];

    public $create, $show, $edit, $import;
    public $kategori, $penerbit, $tempat_terbit;
    public $kategori_id, $penerbit_id, $ebook_id, $tempat_terbit_id;
    public $judul, $penulis, $tahun_terbit, $sampul, $file;
    public $importExcel;
    public $search;

    protected $rules = [
        'judul' => 'required|unique:ebook,judul|min:3|max:100',
        'penulis' => 'required|min:3|max:60',
        'tahun_terbit' => 'required|numeric|digits:4',
        'sampul' => 'required|image|mimes:jpg,jpeg,png|max:3072',
        'file' => 'required|file|mimes:pdf|max:102400',
        'kategori_id' => 'required|numeric|min:1',
        'penerbit_id' => 'required|numeric|min:1',
        'tempat_terbit_id' => 'required|numeric|min:1',
    ];

    protected $validationAttributes = [
        'kategori_id' => 'kategori',
        'penerbit_id' => 'penerbit',
        'tempat_terbit_id' => 'tempat terbit',
    ];

    public function import()
    {
        $this->format();
        $this->import = true;
    }

    public function exampleTemplate()
    {
        $filename = 'panduan-import-ebook.zip';
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

        Excel::import(new EbookImport, $this->importExcel);
        $this->emit('success', ['pesan' => 'Data berhasil diimpor']);
        $this->format();
    }

    public function export()
    {

        $this->format();
        return Excel::download(new EbookExport, 'Perpustakaan SMPN 34 Jakarta-Data E-book.xlsx');
    }

    public function create()
    {
        $this->format();
        $this->create = true;
        $this->kategori = Kategori::all();
        $this->penerbit = Penerbit::all();
        $this->tempat_terbit = TempatTerbit::all();
    }

    public function store()
    {
        $this->validate();

        $namaSampul = time() . '-' . $this->sampul->getClientOriginalName();
        $this->sampul = $this->sampul->storeAs('ebook', $namaSampul, 'public');

        $namaFile = time() . '-' . $this->file->getClientOriginalName();
        $this->file = $this->file->storeAs('file', $namaFile, 'public');

        ModelsEbook::create([
            'sampul' => $this->sampul,
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'tahun_terbit' => $this->tahun_terbit,
            'file' => $this->file,
            'dilihat' => 0,
            'kategori_id' => $this->kategori_id,
            'penerbit_id' => $this->penerbit_id,
            'tempat_terbit_id' => $this->tempat_terbit_id,
            'slug' => Str::slug($this->judul)
        ]);

        $tambahDigunakan = Kategori::where('id', $this->kategori_id)->firstOrFail();
        $tambahDigunakan->increment('digunakan');

        $this->emit('success', ['pesan' => 'Data berhasil ditambahkan']);

        $this->format();
    }

    public function show(ModelsEbook $ebook)
    {
        $this->format();
        $this->show = true;
        $this->judul = $ebook->judul;
        $this->sampul = $ebook->sampul;
        $this->penulis = $ebook->penulis;
        $this->file = $ebook->file;
        $this->tahun_terbit = $ebook->tahun_terbit;
        $this->kategori = $ebook->kategori->nama;
        $this->penerbit = $ebook->penerbit->nama;
        $this->tempat_terbit = $ebook->tempat_terbit->nama;
    }

    public function edit(ModelsEbook $ebook)
    {
        $this->format();

        $this->edit = true;
        $this->ebook_id = $ebook->id;
        $this->judul = $ebook->judul;
        $this->penulis = $ebook->penulis;
        $this->tahun_terbit = $ebook->tahun_terbit;
        $this->kategori_id = $ebook->kategori_id;
        $this->penerbit_id = $ebook->penerbit_id;
        $this->tempat_terbit_id = $ebook->tempat_terbit_id;
        $this->kategori = Kategori::all();
        $this->penerbit = Penerbit::all();
        $this->tempat_terbit = TempatTerbit::all();
    }

    public function update(ModelsEbook $ebook)
    {
        $validasi = [
            'penulis' => 'required|min:3|max:60',
            'tahun_terbit' => 'required|numeric|digits:4',
            'kategori_id' => 'required|numeric|min:1',
            'penerbit_id' => 'required|numeric|min:1',
            'tempat_terbit_id' => 'required|numeric|min:1',
        ];

        if ($this->judul != $ebook->judul) {
            $validasi['judul'] = 'required|unique:ebook|min:3|max:100';
        }

        if ($this->sampul) {
            $validasi['sampul'] = 'required|image|mimes:jpg,jpeg,png|max:3072';
        }

        if ($this->file) {
            $validasi['file'] = 'required|file|mimes:pdf|max:102400';
        }

        $this->validate($validasi);
        if ($this->sampul) {
            if ($ebook->sampul != 'ebook/tidak_ada_sampul.png') {
                Storage::disk('public')->delete($ebook->sampul);
            }

            $namaSampul = time() . '-' . $this->sampul->getClientOriginalName();
            $this->sampul = $this->sampul->storeAs('ebook', $namaSampul, 'public');
        } else {
            $this->sampul = $ebook->sampul;
        }

        if ($this->file) {
            if ($ebook->file != NULL) {
                Storage::disk('public')->delete($ebook->file);
            }
            $namaFile = time() . '-' . $this->file->getClientOriginalName();
            $this->file = $this->file->storeAs('file', $namaFile, 'public');
        } else {
            $this->file = $ebook->file;
        }

        if ($this->kategori_id != $ebook->kategori_id) {
            $ebook->kategori->decrement('digunakan');
        }

        $ebook->update([
            'sampul' => $this->sampul,
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'tahun_terbit' => $this->tahun_terbit,
            'file' => $this->file,
            'kategori_id' => $this->kategori_id,
            'penerbit_id' => $this->penerbit_id,
            'tempat_terbit_id' => $this->tempat_terbit_id,
            'slug' => Str::slug($this->judul)
        ]);

        $ebook->kategori->increment('digunakan');

        $this->emit('success', ['pesan' => 'Data berhasil diubah']);

        $this->format();
    }

    public function deleteConfirmation($id)
    {
        $this->format();

        $this->ebook_id = $id;
        $this->dispatchBrowserEvent('show-konfirmasi-hapus');
    }

    public function destroy()
    {
        $ebook = ModelsEbook::where('id', $this->ebook_id)->first();
        if ($ebook->sampul != 'ebook/tidak_ada_sampul.png') {
            Storage::disk('public')->delete($ebook->sampul);
        }

        if ($ebook->file) {
            Storage::disk('public')->delete($ebook->file);
        }
        $ebook->kategori->decrement('digunakan');

        $ebook->delete();

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
            $ebook = ModelsEbook::where('judul', 'like', '%' . $this->search . '%')->paginate(10);
        } else {
            $ebook = ModelsEbook::paginate(10);
        }
        return view('livewire.petugas.ebook', compact('ebook'));
    }

    public function format()
    {
        unset($this->create);
        unset($this->show);
        unset($this->edit);
        unset($this->kategori);
        unset($this->import);
        unset($this->importExcel);
        unset($this->penerbit);
        unset($this->tahun_terbit);
        unset($this->tempat_terbit);
        unset($this->kategori_id);
        unset($this->penerbit_id);
        unset($this->tempat_terbit_id);
        unset($this->ebook_id);
        unset($this->judul);
        unset($this->penulis);
        unset($this->sampul);
        unset($this->file);
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
