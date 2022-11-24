<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use App\Exports\GuruExport;
use App\Imports\GuruImport;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Guru as ModelsGuru;
use Maatwebsite\Excel\Facades\Excel;

class Guru extends Component
{

    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $create, $nama, $nip, $edit, $guru_id, $delete;
    public $search, $import, $importExcel;

    protected $rules = [
        'nama' => 'required|min:3|max:60',
        'nip' => 'required|digits_between:7,18|unique:guru,nip',
    ];
    protected $listeners = [
        'konfirmasiHapus' => 'destroy',
        'konfirmasiHapusSemua' => 'destroyAll',
    ];

    public function import()
    {
        $this->format();
        $this->import = true;
    }

    public function exampleTemplate()
    {
        $filename = 'contoh_import_guru.xlsx';
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

        Excel::import(new GuruImport, $this->importExcel);
        $this->emit('success', ['pesan' => 'Data berhasil diimpor']);
        $this->format();
    }

    public function export()
    {

        $this->format();
        return Excel::download(new GuruExport, 'guru.xlsx');
    }

    public function create()
    {
        $this->format();

        $this->create = true;
    }

    public function store()
    {
        $this->validate();
        ModelsGuru::create([
            "nama" => $this->nama,
            "nip" => $this->nip,
        ]);

        $this->emit('success', ['pesan' => 'Data berhasil ditambahkan']);

        $this->format();
    }

    public function edit(ModelsGuru $guru)
    {
        $this->format();

        $this->edit = true;
        $this->nama = $guru->nama;
        $this->nip = $guru->nip;
        $this->guru_id = $guru->id;
    }

    public function update(ModelsGuru $guru)
    {
        $user = User::all();

        $validasi = [
            'nama' => 'required|min:3|max:60',
        ];
        if ($this->nip != $guru->nip) {
            $validasi['nip'] = 'required|digits_between:7,18|unique:guru,nip|unique:users,kode';
        }

        $this->validate($validasi);

        if ($this->guru_id) {
            $guru = ModelsGuru::find($this->guru_id);
            $guru->update([
                'nama' => $this->nama,
                'nip' => $this->nip,
            ]);
            foreach ($user as $item) {
                if ($this->guru_id == $item->guru_id) {
                    $item = User::where('guru_id', $this->guru_id)->first();
                    $item->update([
                        'nama' => $guru->nama,
                        'kode' => $guru->nip,
                    ]);
                }
            }
        }

        $this->emit('success', ['pesan' => 'Data berhasil diubah']);

        $this->format();
    }

    public function deleteConfirmation($id)
    {
        $this->format();

        $this->guru_id = $id;
        $this->dispatchBrowserEvent('show-konfirmasi-hapus');
    }

    public function deleteAllConfirmation()
    {
        $this->format();

        $this->dispatchBrowserEvent('show-konfirmasi-hapusSemua');
    }

    public function destroy()
    {
        $guru = ModelsGuru::where('id', $this->guru_id)->first();
        if (isset($guru->user->nama)) {
            $user = User::where('guru_id', $guru->id)->get();
            $user[0]->delete();
            $guru->delete();
        } else {
            $guru->delete();
        }

        $this->emit('success', ['pesan' => 'Data berhasil dihapus']);

        $this->format();
    }

    public function destroyAll()
    {
        $guru = ModelsGuru::all();
        foreach ($guru as $item) {
            $item->delete();
        }

        if ($guru->isEmpty()) {
            $this->emit('failed', ['pesan' => 'Data tidak ada']);
            $this->format();
        } else {
            $this->emit('success', ['pesan' => 'Data berhasil dihapus']);
            $this->format();
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        sleep(0.5);
        if ($this->search) {
            $guru = ModelsGuru::where('nama', 'like', '%' . $this->search . '%')->paginate(10);
        } else {
            $guru = ModelsGuru::paginate(10);
        }

        return view('livewire.admin.guru', compact('guru'));
    }

    public function format()
    {
        unset($this->guru_id);
        unset($this->nama);
        unset($this->create);
        unset($this->nip);
        unset($this->edit);
        unset($this->import);
        unset($this->importExcel);
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
