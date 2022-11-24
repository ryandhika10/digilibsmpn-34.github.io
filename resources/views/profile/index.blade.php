@extends('layouts/dashboard/main')
@section('title', 'Profil')
@section('active-profile', 'text-light')
@section('content')
    <section class="profile" id="profile">
        <div class="row">
            <div class="col-md-12">
                <form action="/profile/{{ $user->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') ? old('nama') : $user->nama }}" disabled>
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    @if (isset($user->foto))
                                        <img src="/storage/{{ $user->foto }}" alt="{{ $user->nama }}" width="100%" height="170px" class="mt-2">
                                    @else
                                        <img src="/storage/foto-user/user.png" alt="{{ $user->nama }}" width="100%" height="150px" class="mt-2">
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <div class="mb-3">
                                        <label for="foto" class="form-label">Foto</label>
                                        <input type="file" class="form-control" id="foto" name="foto">
                                        @error('foto')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    @if ($user->hasRole('siswa'))
                                        <div class="mb-3">
                                            <label for="kelas" class="form-label">Kelas</label>
                                            <input type="text" name="kelas" id="kelas" class="form-control" value="{{ old('kelas') ? old('kelas') : $user->siswa->kelas }}" disabled>
                                        </div>
                                    @endif
                                    @if ($user->hasRole('guru'))
                                        <div class="col-md-3">
                                            <label for="nip" class="form-label">NIP</label>
                                            <input type="text" name="nip" id="nip" class="form-control" value="{{ old('nip') ? old('nip') : $user->guru->nip }}" disabled>
                                        </div>
                                    @endif
                                    @if ($user->hasRole('admin') || $user->hasRole('petugas'))
                                        <div class="col-md-3">
                                            <label for="kode" class="form-label">Kode</label>
                                            <input type="text" name="kode" id="kode" class="form-control" value="{{ old('kode') ? old('kode') : $user->kode }}" disabled>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if ($user->hasRole('siswa'))
                                <div class="mb-3">
                                    <label for="nis" class="form-label">NIS</label>
                                    <input type="text" name="nis" id="nis" class="form-control" value="{{ old('nis') ? old('nis') : $user->siswa->nis }}" disabled>
                                </div>
                            @endif
                            <div class="mb-5">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') ? old('email') : $user->email }}" disabled>
                            </div>
                                <button type="submit" class="btn btn-success">Update Profil</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection