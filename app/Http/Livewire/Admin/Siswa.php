<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
use App\Models\Siswa as ModelsSiswa;

class Siswa extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'konfirmasiHapus' => 'destroy',
        'konfirmasiHapusSemua' => 'destroyAll',
    ];

    public $create, $nama, $kelas, $nis, $edit, $siswa_id, $delete;
    public $search, $import, $importExcel;

    protected $rules = [
        'nama' => 'required|min:3|max:60',
        'kelas' => 'required|min:2|max:2',
        'nis' => 'required|digits:5|unique:siswa,nis|unique:users,kode',
    ];

    public function import()
    {
        $this->format();
        $this->import = true;
    }

    public function exampleTemplate()
    {
        $filename = 'contoh_import_siswa.xlsx';
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

        Excel::import(new SiswaImport, $this->importExcel);
        $this->emit('success', ['pesan' => 'Data berhasil diimpor']);
        $this->format();
    }

    public function export()
    {

        $this->format();
        return Excel::download(new SiswaExport, 'siswa.xlsx');
    }

    public function create()
    {
        $this->format();

        $this->create = true;
    }

    public function store()
    {
        $this->validate();
        ModelsSiswa::create([
            "nama" => $this->nama,
            "kelas" => $this->kelas,
            "nis" => $this->nis,
        ]);

        $this->emit('success', ['pesan' => 'Data berhasil ditambahkan']);

        $this->format();
    }

    public function edit(ModelsSiswa $siswa)
    {
        $this->format();

        $this->edit = true;
        $this->nama = $siswa->nama;
        $this->kelas = $siswa->kelas;
        $this->nis = $siswa->nis;
        $this->siswa_id = $siswa->id;
    }

    public function update(ModelsSiswa $siswa)
    {
        $user = User::all();

        $validasi = [
            'nama' => 'required|min:3|max:60',
            'kelas' => 'required|min:2|max:2',
            'nis' => 'required|digits:5'
        ];
        if ($this->nis != $siswa->nis) {
            $validasi['nis'] = 'required|digits:5|unique:siswa,nis|unique:users,kode';
        }

        $this->validate($validasi);

        if ($this->siswa_id) {
            $siswa = ModelsSiswa::find($this->siswa_id);
            $siswa->update([
                'nama' => $this->nama,
                'kelas' => $this->kelas,
                'nis' => $this->nis,
            ]);
            foreach ($user as $item) {
                if ($this->siswa_id == $item->siswa_id) {
                    $item = User::where('siswa_id', $this->siswa_id)->first();
                    $item->update([
                        'nama' => $siswa->nama,
                        'kode' => $siswa->nis,
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

        $this->siswa_id = $id;
        $this->dispatchBrowserEvent('show-konfirmasi-hapus');
    }

    public function deleteAllConfirmation()
    {
        $this->format();

        $this->dispatchBrowserEvent('show-konfirmasi-hapusSemua');
    }

    public function destroy()
    {
        $siswa = ModelsSiswa::where('id', $this->siswa_id)->first();
        $kelas = ['9A', '9B', '9C', '9D', '9E', '9F', '9G', '9H'];
        foreach ($kelas as $value) {
            if ($siswa->kelas == $value) {
                $kelas = $siswa->kelas;
            }
        }
        if ($siswa->kelas == $kelas) {
            if (isset($siswa->user->nama)) {
                $user = User::where('siswa_id', $siswa->id)->firstOrFail();
                $user->removeRole('siswa');
                $user->assignRole('alumni');
                $siswa->delete();
            } else {
                $siswa->delete();
            }
        } else {
            $siswa->delete();
        }

        $this->emit('success', ['pesan' => 'Data berhasil dihapus']);

        $this->format();
    }

    public function destroyAll()
    {
        $siswa = ModelsSiswa::all();
        $kelas = ['9A', '9B', '9C', '9D', '9E', '9F', '9G', '9H'];

        // Cari siswa kelas 9
        foreach ($siswa as $value) {
            foreach ($kelas as $kelasSembilan) {
                if ($value->kelas == $kelasSembilan) {
                    $siswaKelasSembilan[] = $value;
                }
            }
        }

        // Cek jika ada akun
        if (isset($siswaKelasSembilan)) {
            foreach ($siswaKelasSembilan as $item) {
                if (isset($item->user->nama)) {
                    $user[] = User::where('siswa_id', $item->id)->firstOrFail();
                } else {
                    $tidakAdaUser[] = $item;
                }
            }
        }

        // Ubah semua role pada akun siswa kelas 9 ke alumni dan hapus data siswa
        if (isset($user)) {
            foreach ($user as $key) {
                $key->removeRole('siswa');
                $key->assignRole('alumni');
                $student = ModelsSiswa::where('id', $key->siswa_id)->firstOrFail();
                $student->delete();
            }
        }
        // Hapus kelas 9 jika tidak memiliki akun
        if (isset($tidakAdaUser)) {
            foreach ($tidakAdaUser as $value) {
                $value->delete();
            }
        }
        // Cari data selain kelas 9
        foreach ($kelas as $value) {
            $selainKelasSembilan = ModelsSiswa::whereNot('kelas', $value)->get();
        }

        // Hapus semua siswa selain kelas 9
        if (isset($selainKelasSembilan)) {
            foreach ($selainKelasSembilan as $item) {
                $item->delete();
            }
        }

        if ($siswa->isEmpty()) {
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
            $siswa = ModelsSiswa::where('nama', 'like', '%' . $this->search . '%')->latest()->paginate(10);
        } else {
            $siswa = ModelsSiswa::orderBy('kelas', 'asc')->latest()->paginate(10);
        }

        return view('livewire.admin.siswa', compact('siswa'));
    }

    public function format()
    {
        unset($this->siswa_id);
        unset($this->nama);
        unset($this->create);
        unset($this->kelas);
        unset($this->nis);
        unset($this->edit);
        unset($this->import);
        unset($this->importExcel);
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
