@extends('layouts/app')
@section('content')
    <section class="detailBuku" id="detailBuku">
        <div class="container mt-5">
            <h1 class="heading">Detail Buku</h1>
            <div class="row bg-light rounded p-3 shadow">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('failed'))
                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                            {{ session('failed') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <img src="/storage/{{ $buku->sampul }}" alt="{{ $buku->judul }}" width="300" height="400">
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Judul</th>
                                    <td>:</td>
                                    <td>{{ $buku->judul }}</td>
                                </tr>
                                <tr>
                                    <th>Penulis</th>
                                    <td>:</td>
                                    <td>{{ $buku->penulis }}</td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td>:</td>
                                    <td>{{ $buku->kategori->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Penerbit</th>
                                    <td>:</td>
                                    <td>{{ $buku->penerbit->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Terbit</th>
                                    <td>:</td>
                                    <td>{{ $buku->tahun_terbit }}</td>
                                </tr>
                                <tr>
                                    <th>Tempat Terbit</th>
                                    <td>:</td>
                                    <td>{{ $buku->tempat_terbit->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Rak</th>
                                    <td>:</td>
                                    <td>{{ $buku->rak->rak }}</td>
                                </tr>
                                <tr>
                                    <th>Baris</th>
                                    <td>:</td>
                                    <td>{{ $buku->rak->baris }}</td>
                                </tr>
                                <tr>
                                    <th>Stok</th>
                                    <td>:</td>
                                    <td>{{ $buku->stok }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex">
                            <a href="/buku" class="btn btn-secondary me-2"><i class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
                            <form action="/buku/{{ $buku->slug }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i> Keranjang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection