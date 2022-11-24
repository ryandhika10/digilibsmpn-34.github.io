@extends('layouts/app')
@section('content')
    <section class="detail-keranjang" id="detail-keranjang">
        <div class="container mt-5">
            <h1 class="heading mb-3">Keranjang</h1>
            <div class="keranjang-wrapper bg-white shadow rounded">
                <div class="row p-4">
                    <div class="col-md-3">
                        <div class="mb-4 kembali">
                            <a href="/buku" class="btn"><i class="fa-solid fa-arrow-left"></i> Kembali ke Semua Buku</a>
                        </div>
                    </div>
                    <div class="col-md-9 float-end">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4 mb-2">
                        @if (!$keranjang->tanggal_pinjam)
                            <form action="/buku/keranjang/pinjam" method="post">
                                @csrf
                                <label for="tanggal_pinjam" class="mb-2"><strong class="mainfont">Tanggal Pinjam</strong></label>
                                <input class="form-control @error ('tanggal_pinjam') is-invalid @enderror" name="tanggal_pinjam" type="date" id="tanggal_pinjam">
                                @error('tanggal_pinjam') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                                <button class="btn btn-sm btn-primary mt-3" type="submit"><i class="fa-solid fa-book"></i> Pinjam Buku</button>
                            </form>
                        @endif
                    </div>
                    <div class="col-md-12 mb-2">
                        @if ($keranjang->tanggal_pinjam)
                            <strong>Tanggal Pinjam : {{ Carbon\Carbon::parse($keranjang->tanggal_pinjam)->format('d F Y') }}</strong>
                        @endif
                        <strong class="float-end">Kode Pinjam : {{ $keranjang->kode_pinjam }}</strong>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-hover table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th width ="5%" class="text-center">No</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Rak</th>
                                    <th>Baris</th>
                                    @if (!$keranjang->tanggal_pinjam)
                                        <th width="10%" class="text-center">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($keranjang->detail_peminjaman as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->buku->judul }}</td>
                                        <td>{{ $item->buku->penulis }}</td>
                                        <td>{{ $item->buku->rak->rak }}</td>
                                        <td>{{ $item->buku->rak->baris }}</td>
                                        @if (!$keranjang->tanggal_pinjam)
                                            <td class="text-center">
                                                <a href="/buku/keranjang/{{ $item->id }}/konfirmasi" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i> Hapus</a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (!$keranjang->tanggal_pinjam)
                            <form action="/buku/keranjang/hapusSemua" method="post">
                                @csrf
                                <button class="btn btn-sm btn-danger mt-2"><i class="fa-solid fa-trash-can"></i> Hapus Semua</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection