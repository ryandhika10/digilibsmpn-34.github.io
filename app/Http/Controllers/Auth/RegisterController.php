<?php

namespace App\Http\Controllers\Auth;

use App\Models\Guru;
use App\Models\User;
use App\Models\Siswa;
use App\Rules\Lowercase;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register_sebagai()
    {
        return view('auth.register_sebagai', [
            'title' => ' | Register Sebagai'
        ]);
    }
    public function siswa_register()
    {
        return view('auth.siswa_register', [
            'title' => ' | Siswa Register'
        ]);
    }
    public function guru_register()
    {
        return view('auth.guru_register', [
            'title' => ' | Guru Register'
        ]);
    }

    public function storeSiswa(Request $request)
    {
        $request->nama = Str::title($request->nama);
        $validatedData = [
            'nama' => 'required|max:60|min:3|exists:siswa,nama',
            'username' => 'required|max:60|min:3|unique:users,username',
            'nis' => ['required', 'digits:5', Rule::exists('siswa', 'nis')->where('nama', $request->nama)],
            'email' => 'required|email:dns|unique:users,email',
            'password' => ['required', 'confirmed', new Lowercase]
        ];

        $request->validate($validatedData);

        $siswa = Siswa::where('nis', $request->nis)->firstOrFail();
        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'kode' => $request->nis,
            'email' => $request->email,
            'siswa_id' => $siswa->id,
            'password' => Hash::make($request->password),
        ])->assignRole('siswa');

        return redirect('/login')->with('success', 'Registrasi berhasil! Silahkan masuk');
    }

    public function storeGuru(Request $request)
    {
        $request->nama = Str::title($request->nama);
        $validatedData = [
            'nama' => 'required|max:60|min:3|exists:guru,nama',
            'username' => 'required|max:60|min:3|unique:users,username',
            'nip' => ['required', 'digits_between:7,18', 'alpha_num', Rule::exists('guru', 'nip')->where('nama', $request->nama)],
            'email' => 'required|email:dns|unique:users,email',
            'password' => ['required', 'confirmed', new Lowercase]
        ];

        $request->validate($validatedData);
        $guru = Guru::where('nip', $request->nip)->firstOrFail();

        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'kode' => $request->nip,
            'email' => $request->email,
            'guru_id' => $guru->id,
            'password' => Hash::make($request->password),
        ])->assignRole('guru');

        return redirect('/login')->with('success', 'Registrasi berhasil! Silahkan masuk');
    }
}
