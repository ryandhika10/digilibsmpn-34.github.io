<?php

namespace App\Http\Livewire\Petugas;

use App\Models\Buku;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Exports\PenerbitExport;
use App\Imports\PenerbitImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Penerbit as ModelsPenerbit;

class Penerbit extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['konfirmasiHapus' => 'destroy'];

    public $create, $edit;
    public $nama, $penerbit_id, $import, $importExcel;
    public $search;

    protected $rules = [
        'nama' => 'required|unique:penerbit|min:3|max:60',
    ];

    public function import()
    {
        $this->format();
        $this->import = true;
    }

    public function exampleTemplate()
    {
        $filename = 'contoh_import_penerbit.xlsx';
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

        Excel::import(new PenerbitImport, $this->importExcel);
        $this->emit('success', ['pesan' => 'Data berhasil diimpor']);
        $this->format();
    }

    public function export()
    {

        $this->format();
        return Excel::download(new PenerbitExport, 'penerbit.xlsx');
    }

    public function create()
    {
        $this->create = true;
    }

    public function store()
    {
        $this->validate();

        ModelsPenerbit::create([
            'nama' => $this->nama,
            'slug' => Str::slug($this->nama)
        ]);

        $this->emit('success', ['pesan' => 'Data berhasil ditambahkan']);

        $this->format();
    }

    public function edit(ModelsPenerbit $penerbit)
    {
        $this->format();

        $this->nama = $penerbit->nama;
        $this->penerbit_id = $penerbit->id;
        $this->edit = true;
    }

    public function update(ModelsPenerbit $penerbit)
    {
        $validasi = [
            'nama' => 'required|min:3|max:60',
        ];

        if ($this->nama != $penerbit->nama) {
            $validasi['nama'] = 'required|unique:penerbit|min:3|max:30';
        }

        $this->validate($validasi);

        if ($this->penerbit_id) {
            $penerbit = ModelsPenerbit::find($this->penerbit_id);
            $penerbit->update([
                'nama' => $this->nama,
                'slug' => Str::slug($this->nama)
            ]);
        }
        $this->emit('success', ['pesan' => 'Data berhasil diubah']);

        $this->format();
    }

    public function deleteConfirmation($id)
    {
        $this->penerbit_id = $id;
        $this->dispatchBrowserEvent('show-konfirmasi-hapus');
    }

    public function destroy()
    {
        $penerbit = ModelsPenerbit::where('id', $this->penerbit_id)->first();
        $buku = Buku::where('penerbit_id', $penerbit->id)->get();
        foreach ($buku as $key => $value) {
            $value->update([
                'penerbit_id' => 1
            ]);
        }
        $penerbit->delete();

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
            $penerbit = ModelsPenerbit::where('nama', 'like', '%' . $this->search . '%')->whereNot('id', 1)->paginate(10);
        } else {
            $penerbit = ModelsPenerbit::whereNot('id', 1)->paginate(10);
        }

        return view('livewire.petugas.penerbit', compact('penerbit'));
    }

    public function format()
    {
        unset($this->create);
        unset($this->edit);
        unset($this->nama);
        unset($this->penerbit_id);
        unset($this->import);
        unset($this->importExcel);
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
