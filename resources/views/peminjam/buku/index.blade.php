@extends('layouts/app')
@section('content')

    <!-- HERO SECTION -->
    <section class="hero-buku">
        <div class="container">
            <div class="search-wrapper col-md-8 mx-auto mb-4" data-aos="fade-down">
                <h2 class="mb-1 justify-content-center text-center">{{ $titleBuku }}</h2>
                <div class="row justify-content-center mb-2">
                    <div class="col-md-8">
                        <form action="/buku">
                            @if (request('kategori'))
                                <input type = "hidden" name = "kategori" value = "{{ request('kategori') }}">
                            @endif
                            
                            @if (request('penerbit'))
                                <input type = "hidden" name = "penerbit" value = "{{ request('penerbit') }}">
                            @endif
                            
                            @if (request('tempat_terbit'))
                                <input type = "hidden" name = "tempat_terbit" value = "{{ request('tempat_terbit') }}">
                            @endif
                            <div class="input-group mb-1">
                                <input type="text" class="form-control" placeholder="Cari: Judul, Penulis, ..." name="search" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if ($buku->count())
                @if ($count > 0)
                    <div class="d-flex justify-content-end keranjang mb-3">
                        <a href="buku/keranjang" class="btn btn-sm shadow" aria-current="page"><i class="fa-solid fa-cart-shopping"></i> Keranjang <span class="badge bg-danger p-2">{{ $count }}</span></a>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row bg-white p-3 rounded shadow">
                            @foreach ($buku as $item)
                                <div class="col-lg-3 mb-4">
                                    <div class="daftar-buku first-img shadow">
                                        @if ($item->sampul)
                                            <a href="/buku/{{ $item->slug }}"><img src="{{ asset('storage/' . $item->sampul) }}" alt="{{ $item->kategori->nama }}" class="img-fluid rounded-3" style="height: 280px !important;"></a>
                                        @else
                                            <img src="https://source.unsplash.com/random/500x500?{{ $item->kategori->nama }}" class="img-fluid" alt="{{ $item->kategori->nama }}">
                                        @endif
                                        <div class="hero-buku-badges text-center">
                                            <a href="/buku?penerbit={{ $item->penerbit->slug }}" class="text-decoration-none p-2 mb-1"> {{ $item->penerbit->nama }}</a>
                                            <a class="p-2 px-3" href="/buku?kategori={{ $item->kategori->slug }}">{{ $item->kategori->nama }}</a>
                                        </div>
                                        <div class="hero-buku-content rounded-bottom">
                                            <div class="row d-flex justify-content-center align-items-center text-break">
                                                <div class="col-md-10">
                                                    <h5 class="mt-1"><a href="/buku/{{ $item->slug }}" class="text-decoration-none">{{ $item->judul }}</a></h5>
                                                    <h6 class="mt-1">Penulis, {{ $item->penulis }}</a></h6>
                                                    <h6 class="mt-2">{{ $item->dilihat }} x dilihat &#183; <span>{{$item->created_at->diffForHumans()}}</span></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @if ($buku->count() || $semuaKategori->count())
                        <aside class="col-lg-4 px-4">
                            <div class="bg-light px-3 author-wrapper rounded-1 shadow">
                                <div class="row heading-wrapper ps-2 mb-3">
                                    <h4 class="aside-heading pt-2">Kategori Terpopuler<i class="fa-solid fa-thumbs-up float-end"></i></h4>
                                </div>
                                <div class="badges w-100">
                                    @foreach ($semuaKategori->take(7) as $item)
                                        <a href="/buku?kategori={{ $item->slug }}">{{ $item->nama }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </aside>
                    @endif
                </div>
            @else
                <div class="row mt-5 justify-content-center text-center">
                    <div class="col-md-5">
                        <div class="alert alert-info" role="alert">
                            <h5>Tidak ada buku ditemukan</h5>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <div class="d-flex justify-content-center">
        {{ $buku->links() }}
    </div>
@endsection