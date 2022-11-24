<?php

namespace App\Http\Livewire\Petugas;

use App\Models\Rak;
use App\Models\Buku;
use App\Models\Post;
use App\Models\Ebook;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Exports\KategoriExport;
use App\Imports\KategoriImport;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Kategori as ModelsKategori;
use App\Rules\Badwords;

class Kategori extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['konfirmasiHapus' => 'destroy'];

    public $create, $nama, $edit, $kategori_id, $buku, $ebook, $seleksiKategori;
    public $search, $import, $importExcel;

    public function import()
    {
        $this->format();
        $this->import = true;
    }

    public function exampleTemplate()
    {
        $filename = 'contoh_import_kategori.xlsx';
        $path = public_path('file/' . $filename);

        return response()->download($path, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename=$filename'
        ]);
    }

    public function simpanImport()
    {
        $this->validate([
            'importExcel' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new KategoriImport, $this->importExcel);

        $kategori = ModelsKategori::all();
        foreach ($kategori as $value) {
            if ($value->jenis_kategori_id == 0) {
                $value->delete();
            }
        }
        $kategoriBuku =
            DB::table('kategori')
            ->select('nama', DB::raw('count(nama) as occurrences'))
            ->where('jenis_kategori_id', 1)
            ->groupBy('nama')
            ->having('occurrences', '>', 1)
            ->get();

        foreach ($kategoriBuku as $value) {
            $janganDihapus = ModelsKategori::where('nama', $value->nama)->first();
            ModelsKategori::where('nama', $value->nama)->where('id', '!=', $janganDihapus->id)->delete();
        }

        $kategoriEbook =
            DB::table('kategori')
            ->select('nama', DB::raw('count(nama) as occurrences'))
            ->where('jenis_kategori_id', 2)
            ->groupBy('nama')
            ->having('occurrences', '>', 1)
            ->get();

        foreach ($kategoriEbook as $value) {
            $janganDihapus = ModelsKategori::where('nama', $value->nama)->first();
            ModelsKategori::where('nama', $value->nama)->where('id', '!=', $janganDihapus->id)->delete();
        }

        $this->emit('success', ['pesan' => 'Data berhasil diimpor']);
        $this->format();
    }

    public function export()
    {

        $this->format();
        return Excel::download(new KategoriExport, 'kategori.xlsx');
    }

    public function buku()
    {
        $this->format();
        $this->buku = true;
        $this->updatingSearch();
    }

    public function ebook()
    {
        $this->format();
        $this->ebook = true;
        $this->updatingSearch();
    }

    public function create()
    {
        $this->create = true;
        $this->updatingSearch();
    }

    public function store()
    {
        if ($this->buku) {
            $this->hapusSeleksi();
            $kategori = ModelsKategori::where('jenis_kategori_id', 1)->get();
            foreach ($kategori as $value) {
                if ($this->nama == $value->nama || $this->nama == $value->slug) {
                    $this->seleksiKategori = $value->nama;
                }
            }
            if (isset($this->seleksiKategori)) {
                $validasi['nama'] = 'required|min:3|max:30|unique:kategori';
            } else {
                $validasi['nama'] = 'required|min:3|max:30';
            }
            $this->validate($validasi);

            ModelsKategori::create([
                'nama' => $this->nama,
                'slug' => Str::slug($this->nama),
                'digunakan' => 0,
                'jenis_kategori_id' => 1,
            ]);
        }

        if ($this->ebook) {
            $this->hapusSeleksi();
            $kategori = ModelsKategori::where('jenis_kategori_id', 2)->get();
            foreach ($kategori as $value) {
                if ($this->nama == $value->nama || $this->nama == $value->slug) {
                    $this->seleksiKategori = $value->nama;
                }
            }
            if (isset($this->seleksiKategori)) {
                $validasi['nama'] = 'required|min:3|max:30|unique:kategori';
            } else {
                $validasi['nama'] = 'required|min:3|max:30';
            }
            $this->validate($validasi);

            ModelsKategori::create([
                'nama' => $this->nama,
                'slug' => Str::slug($this->nama),
                'digunakan' => 0,
                'jenis_kategori_id' => 2,
            ]);
        }

        if (Auth::user()->hasRole(['guru', 'siswa', 'alumni'])) {
            $this->hapusSeleksi();
            $kategori = ModelsKategori::where('jenis_kategori_id', 3)->get();
            foreach ($kategori as $value) {
                if ($this->nama == $value->nama || $this->nama == $value->slug) {
                    $this->seleksiKategori = $value->nama;
                }
            }
            if (isset($this->seleksiKategori)) {
                $validasi['nama'] = 'required|min:3|max:30|unique:kategori';
            } else {
                $validasi['nama'] = ['required', 'min:3', 'max:30'];
            }
            $this->validate($validasi);

            ModelsKategori::create([
                'nama' => $this->nama,
                'slug' => Str::slug($this->nama),
                'digunakan' => 0,
                'jenis_kategori_id' => 3,
            ]);
        }

        $this->emit('success', ['pesan' => 'Data berhasil ditambahkan']);

        $this->format();
    }

    public function edit(ModelsKategori $kategori)
    {

        $this->edit = true;
        $this->nama = $kategori->nama;
        $this->kategori_id = $kategori->id;
    }

    public function update()
    {
        $this->nama = ucfirst($this->nama);
        if ($this->kategori_id) {
            $kategori = ModelsKategori::find($this->kategori_id);
            if ($this->buku) {
                if ($this->nama != $kategori->nama) {
                    $validasi['nama'] = ['required', 'max:30', 'min:3', Rule::unique('kategori')->where(fn ($query) => $query->where('jenis_kategori_id', 1))];
                } else {
                    $validasi['nama'] = 'required|max:30|min:3';
                }
                $this->validate($validasi);
                $kategori->update([
                    'nama' => $this->nama,
                    'slug' => Str::slug($this->nama),
                    'jenis_kategori_id' => 1,
                ]);
            } elseif ($this->ebook) {
                if ($this->nama != $kategori->nama) {
                    $validasi['nama'] = ['required', 'max:30', 'min:3', Rule::unique('kategori')->where(fn ($query) => $query->where('jenis_kategori_id', 2))];
                } else {
                    $validasi['nama'] = 'required|max:30|min:3';
                }
                $this->validate($validasi);
                $kategori->update([
                    'nama' => $this->nama,
                    'slug' => Str::slug($this->nama),
                    'jenis_kategori_id' => 2,
                ]);
            } elseif (Auth::user()->hasRole(['siswa', 'guru'])) {
                if ($this->nama != $kategori->nama) {
                    $validasi['nama'] = ['required', 'max:30', 'min:3', Rule::unique('kategori')->where(fn ($query) => $query->where('jenis_kategori_id', 3))];
                } else {
                    $validasi['nama'] = 'required|max:30|min:3';
                }
                $this->validate($validasi);
                $kategori->update([
                    'nama' => $this->nama,
                    'slug' => Str::slug($this->nama),
                    'jenis_kategori_id' => 3,
                ]);
            }
        }

        $this->emit('success', ['pesan' => 'Data berhasil diubah']);

        $this->format();
    }

    public function deleteConfirmation($id)
    {
        $this->kategori_id = $id;
        $this->dispatchBrowserEvent('show-konfirmasi-hapus');
    }

    public function destroy()
    {
        $kategori = ModelsKategori::where('id', $this->kategori_id)->first();
        $rak = Rak::where('kategori_id', $kategori->id)->get();
        foreach ($rak as $key => $value) {
            $value->update([
                'kategori_id' => 1
            ]);
        }

        $buku = Buku::where('kategori_id', $kategori->id)->get();
        foreach ($buku as $key => $value) {
            $value->kategori->decrement('digunakan');
            $value->update([
                'kategori_id' => 1
            ]);
            $value->kategori->increment('digunakan');
        }

        $ebook = Ebook::where('kategori_id', $kategori->id)->get();
        foreach ($ebook as $key => $value) {
            $value->kategori->decrement('digunakan');
            $value->update([
                'kategori_id' => 2
            ]);
            $value->kategori->increment('digunakan');
        }

        $blog = Post::where('kategori_id', $kategori->id)->get();
        foreach ($blog as $key => $value) {
            $value->kategori->decrement('digunakan');
            $value->update([
                'kategori_id' => 3
            ]);
            $value->kategori->increment('digunakan');
        }

        $kategori->delete();

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
            if ($this->buku) {
                $kategori = ModelsKategori::where('jenis_kategori_id', 1)->where('nama', 'like', '%' . $this->search . '%')->whereNot('slug', '=', 'none')->orderBy('nama', 'asc')->paginate(10);
            } elseif ($this->ebook) {
                $kategori = ModelsKategori::where('jenis_kategori_id', 2)->where('nama', 'like', '%' . $this->search . '%')->whereNot('slug', '=', 'none')->orderBy('nama', 'asc')->paginate(10);
            } elseif (Auth::user()->hasRole(['guru', 'siswa', 'alumni'])) {
                $kategori = ModelsKategori::where('jenis_kategori_id', 3)->where('nama', 'like', '%' . $this->search . '%')->whereNot('slug', '=', 'none')->orderBy('nama', 'asc')->paginate(10);
            } else {
                $kategori = ModelsKategori::where('nama', 'like', '%' . $this->search . '%')->whereNot('jenis_kategori_id', 3)->whereNot('slug', '=', 'none')->orderBy('jenis_kategori_id')->orderBy('nama', 'asc')->paginate(10);
            }
        } else {
            if ($this->buku) {
                $kategori = ModelsKategori::where('jenis_kategori_id', 1)->whereNot('slug', '=', 'none')->orderBy('nama', 'asc')->paginate(10);
            } elseif ($this->ebook) {
                $kategori = ModelsKategori::where('jenis_kategori_id', 2)->whereNot('slug', '=', 'none')->orderBy('nama', 'asc')->paginate(10);
            } elseif (Auth::user()->hasRole(['guru', 'siswa', 'alumni'])) {
                $kategori = ModelsKategori::where('jenis_kategori_id', 3)->whereNot('slug', '=', 'none')->orderBy('nama', 'asc')->paginate(10);
            } else {
                $kategori = ModelsKategori::whereNot('slug', '=', 'none')->whereNot('jenis_kategori_id', 3)->orderBy('jenis_kategori_id')->orderBy('nama', 'asc')->paginate(10);
            }
        }

        return view('livewire.petugas.kategori', compact('kategori'));
    }

    public function format()
    {
        unset($this->kategori_id);
        $this->buku = false;
        $this->ebook = false;
        unset($this->nama);
        unset($this->create);
        unset($this->edit);
        unset($this->delete);
        unset($this->import);
        unset($this->importExcel);
        $this->resetErrorBag();
        $this->resetValidation();
        $this->updatingSearch();
    }

    public function hapusSeleksi()
    {
        unset($this->seleksiKategori);
    }
}
