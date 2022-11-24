<?php

namespace App\Http\Livewire\Petugas;

use App\Models\Rak;
use App\Models\Buku;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Exports\TempatTerbitExport;
use App\Imports\TempatTerbitImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\TempatTerbit as ModelsTempatTerbit;

class TempatTerbit extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['konfirmasiHapus' => 'destroy'];

    public $create, $nama, $edit, $tempatTerbit_id, $import, $importExcel;
    public $search;

    protected $rules = [
        'nama' => 'required|min:5|max:30|unique:tempat_terbit',
    ];

    public function import()
    {
        $this->format();
        $this->import = true;
    }

    public function exampleTemplate()
    {
        $filename = 'contoh_import_tempat_terbit.xlsx';
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

        Excel::import(new TempatTerbitImport, $this->importExcel);
        $this->emit('success', ['pesan' => 'Data berhasil diimpor']);
        $this->format();
    }

    public function export()
    {

        $this->format();
        return Excel::download(new TempatTerbitExport, 'tempat terbit.xlsx');
    }

    public function create()
    {
        $this->format();

        $this->create = true;
    }

    public function store()
    {
        $this->validate();
        ModelsTempatTerbit::create([
            "nama" => $this->nama,
            "slug" => Str::slug($this->nama)
        ]);

        $this->emit('success', ['pesan' => 'Data berhasil ditambahkan']);

        $this->format();
    }

    public function edit(ModelsTempatTerbit $tempatTerbit)
    {
        $this->format();

        $this->edit = true;
        $this->nama = $tempatTerbit->nama;
        $this->tempatTerbit_id = $tempatTerbit->id;
    }

    public function update(ModelsTempatTerbit $tempatTerbit)
    {
        $validasi = [
            'nama' => 'required|min:3|max:30',
        ];

        if ($this->nama != $tempatTerbit->nama) {
            $validasi['nama'] = 'required|unique:tempat_terbit,nama|min:3|max:30';
        }

        $this->validate($validasi);

        if ($this->tempatTerbit_id) {
            $tempatTerbit = ModelsTempatTerbit::find($this->tempatTerbit_id);
            $tempatTerbit->update([
                'nama' => $this->nama,
                'slug' => Str::slug($this->nama)
            ]);
        }

        $this->emit('success', ['pesan' => 'Data berhasil diubah']);

        $this->format();
    }

    public function deleteConfirmation($id)
    {
        $this->format();

        $this->tempatTerbit_id = $id;
        $this->dispatchBrowserEvent('show-konfirmasi-hapus');
    }

    public function destroy()
    {
        $tempatTerbit = ModelsTempatTerbit::where('id', $this->tempatTerbit_id)->first();
        $buku = Buku::where('tempat_terbit_id', $tempatTerbit->id)->get();
        foreach ($buku as $value) {
            $value->update([
                'tempatTerbit_id' => 1
            ]);
        }
        $tempatTerbit->delete();

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
            $tempatTerbit = ModelsTempatTerbit::where('nama', 'like', '%' . $this->search . '%')->whereNot('id', 1)->paginate(10);
        } else {
            $tempatTerbit = ModelsTempatTerbit::whereNot('id', 1)->paginate(10);
        }

        return view('livewire.petugas.tempat-terbit', compact('tempatTerbit'));
    }

    public function format()
    {
        unset($this->tempatTerbit_id);
        unset($this->nama);
        unset($this->create);
        unset($this->edit);
        unset($this->import);
        unset($this->importExcel);
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
