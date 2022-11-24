<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::whereId(auth()->user()->id)->first();
        return view('profile/index', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validasi = [];
        $data = [];
        $user = User::select('id', 'foto')->whereId($id)->firstOrFail();

        if ($request->foto) {
            $validasi['foto'] = 'required|image|mimes:jpg,jpeg,png|max:3072';
        }

        $request->validate($validasi);

        if (!isset($user->foto)) {
            if ($request->foto) {
                $namaFoto = time() . '-' . $request->foto->getClientOriginalName();
                $foto = $request->foto->storeAs('foto-user', $namaFoto, 'public');

                $data['foto'] = $foto;
            }
        } else {
            if ($request->foto) {
                Storage::disk('public')->delete($user->foto);

                $namaFoto = time() . '-' . $request->foto->getClientOriginalName();
                $foto = $request->foto->storeAs('foto-user', $namaFoto, 'public');

                $data['foto'] = $foto;
            }
        }

        $user->update($data);

        Alert::success('Sukses', 'Data berhasil diubah');
        return redirect('/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
