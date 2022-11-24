<?php

namespace App\Http\Livewire\Admin;

use App\Models\Guru;
use App\Models\Siswa;
use Livewire\Component;
use App\Rules\Lowercase;
use App\Models\Peminjaman;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class User extends Component
{
    use WithPagination;

    public $admin, $petugas, $siswa, $guru, $alumni;
    public $search, $create, $edit, $nama, $email, $password, $user_id, $kode, $nis, $nip;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['konfirmasiHapus' => 'destroy'];

    public function admin()
    {
        $this->format();
        $this->admin = true;
        $this->updatingSearch();
    }

    public function petugas()
    {
        $this->format();
        $this->petugas = true;
        $this->updatingSearch();
    }

    public function siswa()
    {
        $this->format();
        $this->siswa = true;
        $this->updatingSearch();
    }

    public function guru()
    {
        $this->format();
        $this->guru = true;
        $this->updatingSearch();
    }

    public function alumni()
    {
        $this->format();
        $this->alumni = true;
        $this->updatingSearch();
    }

    public function create()
    {
        $this->create = true;
    }

    public function store()
    {
        if ($this->admin || $this->petugas) {
            $this->validate([
                'nama' => ['required', 'min:3', 'max:60'],
                'kode' => ['required', 'min:5', 'max:18', 'unique:users,kode'],
                'email' => 'required|email:dns|unique:users,email',
                'password' => ['required', 'min:5', 'max:20', new Lowercase]
            ]);
            $this->nama = Str::title($this->nama);
            $user = ModelsUser::create([
                'nama' => $this->nama,
                'username' => Str::of($this->nama)->slug('-'),
                'kode' => $this->kode,
                'email' => $this->email,
                'password' => Hash::make($this->password)
            ]);
        } elseif ($this->siswa) {
            $validasi = $this->validate([
                'nama' => ['required', 'min:3', 'max:60', 'exists:siswa,nama'],
                'nis' => ['required', 'digits:5', Rule::exists('siswa', 'nis')->where('nama', $this->nama)],
                'email' => 'required|email:dns|unique:users,email',
                'password' => ['required', 'min:5', 'max:20', new Lowercase]
            ]);
            $siswa = Siswa::where('nis', $validasi['nis'])->get();
            $this->nama = Str::title($this->nama);
            $user = ModelsUser::create([
                'nama' => $this->nama,
                'username' => Str::of($this->nama)->slug('-'),
                'kode' => $this->nis,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'siswa_id' => $siswa[0]->id
            ]);
        } elseif ($this->guru) {
            $validasi = $this->validate([
                'nama' => ['required', 'min:3', 'max:60', 'exists:guru,nama'],
                'nip' => ['required', 'digits_between:7,18', Rule::exists('guru', 'nip')->where('nama', $this->nama)],
                'email' => 'required|email:dns|unique:users,email',
                'password' => ['required', 'min:5', 'max:20', new Lowercase]
            ]);
            $guru = Guru::where('nip', $validasi['nip'])->get();
            $this->nama = Str::title($this->nama);
            $user = ModelsUser::create([
                'nama' => $this->nama,
                'username' => Str::of($this->nama)->slug('-'),
                'kode' => $this->nip,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'guru_id' => $guru[0]->id
            ]);
        }
        if ($this->admin) {
            $user->assignRole('admin');
        } elseif ($this->petugas) {
            $user->assignRole('petugas');
        } elseif ($this->siswa) {
            $user->assignRole('siswa');
        } else {
            $user->assignRole('guru');
        }
        $this->emit('success', ['pesan' => 'Data berhasil ditambahkan']);
        $this->format();
    }

    // Edit

    public function edit(ModelsUser $user)
    {
        $this->format();

        $this->edit = true;
        $this->user_id = $user->id;
        $this->nama = $user->nama;
        $this->kode = $user->kode;
        $this->email = $user->email;
    }

    // Update

    public function update(ModelsUser $user)
    {
        $validasi = [
            'nama' => 'required|min:3|max:60',
            'kode' => 'required|min:5|max:18',
            'email' => 'required|email:dns|max:60',
            'password' => ['required', 'min:5', 'max:20', new Lowercase],
        ];

        if ($this->kode != $user->kode) {
            $validasi['kode'] = 'required|min:5|max:18|unique:users,kode';
        }

        if ($this->email != $user->email) {
            $validasi['email'] = 'required|email:dns|max:60|unique:users,email';
        }

        $this->validate($validasi);

        if ($this->user_id) {
            $user = ModelsUser::find($this->user_id);
            $user->update([
                'nama' => $this->nama,
                'username' => Str::of($this->nama)->slug('-'),
                'kode' => $this->kode,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);
        }

        $this->emit('success', ['pesan' => 'Data berhasil diubah']);

        $this->format();
    }

    // Delete

    public function deleteConfirmation($id)
    {
        $this->format();

        $this->user_id = $id;
        $this->dispatchBrowserEvent('show-konfirmasi-hapus');
    }

    public function destroy()
    {
        $user = ModelsUser::where('id', $this->user_id)->first();
        $user->delete();

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
            if ($this->admin) {
                $user = ModelsUser::role('admin')->where('nama', 'like', '%' . $this->search . '%')->paginate(10);
            } elseif ($this->petugas) {
                $user = ModelsUser::role('petugas')->where('nama', 'like', '%' . $this->search . '%')->paginate(10);
            } elseif ($this->siswa) {
                $user = ModelsUser::role('siswa')->where('nama', 'like', '%' . $this->search . '%')->paginate(10);
            } elseif ($this->guru) {
                $user = ModelsUser::role('guru')->where('nama', 'like', '%' . $this->search . '%')->paginate(10);
            } elseif ($this->alumni) {
                $user = ModelsUser::role('alumni')->where('nama', 'like', '%' . $this->search . '%')->paginate(10);
            } else {
                $user = ModelsUser::where('nama', 'like', '%' . $this->search . '%')->paginate(10);
            }
        } else {
            if ($this->admin) {
                $user = ModelsUser::role('admin')->paginate(10);
            } elseif ($this->petugas) {
                $user = ModelsUser::role('petugas')->paginate(10);
            } elseif ($this->siswa) {
                $user = ModelsUser::role('siswa')->paginate(10);
            } elseif ($this->guru) {
                $user = ModelsUser::role('guru')->paginate(10);
            } elseif ($this->alumni) {
                $user = ModelsUser::role('alumni')->paginate(10);
            } else {
                $user = ModelsUser::paginate(10);
            }
        }

        return view('livewire.admin.user', compact('user'));
    }

    public function format()
    {
        $this->admin = false;
        $this->petugas = false;
        $this->siswa = false;
        $this->guru = false;
        $this->alumni = false;
        unset($this->create);
        unset($this->edit);
        unset($this->nama);
        unset($this->user_id);
        unset($this->kode);
        unset($this->nis);
        unset($this->nip);
        unset($this->email);
        unset($this->password);
        $this->resetErrorBag();
        $this->resetValidation();
        $this->updatingSearch();
    }
}
