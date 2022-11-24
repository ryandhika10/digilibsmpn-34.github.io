@extends('layouts/app')
@section('content')
    <!-- Blog Section -->
    @if ($ebook->count() || $semuaKategori->count())
        <section class="detail-ebook py-3">
            <div class="container">
                <div class="row">
                    @if ($semuaKategori->count())
                        <div class="col-md-8 konten-ebook pb-4 rounded shadow position-relative" style="height: 100%">
                            <div class="mb-3 kembali">
                                <a href="/ebook" class="btn"><i class="fa-solid fa-arrow-left"></i> Kembali ke Semua E-Book</a>
                            </div>
                            <div class="hero-detail-ebook detail-img shadow">
                                <div class="img-wrapper d-flex justify-content-center">
                                    @if ($ebook->sampul)
                                        <img src="{{ asset('storage/' . $ebook->sampul) }}" alt="{{ $ebook->kategori->nama }}" class="img-fluid">
                                    @else
                                        <img src="https://source.unsplash.com/random/600x500?{{ $ebook->kategori->nama }}" class="img-fluid" alt="{{ $ebook->kategori->nama }}">
                                    @endif
                                </div>
                                <div class="hero-ebook-content">
                                    <div class="row d-flex justify-content-between align-items-center py-2">
                                        <div class="col-md-10 text-break ps-5 judul-show">
                                            <h2 class="me-2">{{ $ebook->judul }}</h2>
                                            <h6 class="mt-2">{{ $ebook->dilihat }} x dilihat &#183; <span>{{$ebook->created_at->format('d F Y')}}</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-content p-4 text-break d-none d-lg-block">
                                <embed src="{{ asset('storage/' . $ebook->file) }}" type="" width="100%" height="800px">
                            </div>
                            <div class="p-content p-4 text-break d-flex d-lg-none justify-content-center">
                                <a href="/storage/{{ $ebook->file }}" target="_blank"><button class="btn btn-md text-white ronded-3" type="button"><i class="fa-solid fa-folder-open"></i> Buka File</button></a>
                            </div>
                        </div>
                    @endif
                    @if ($semuaKategori->count())
                        <aside class="col-md-4 px-4">
                            @if ($ebookPopuler->count())
                                <div class="bg-light px-3 author-wrapper ebook-populer-wrapper rounded-1 pb-2 shadow">
                                    <div class="row heading-wrapper ps-2 mb-3">
                                        <h4 class="aside-heading pt-2">E-Book Terpopuler<i class="fa-solid fa-crown position-relative float-end"></i></h4>
                                    </div>
                                    @foreach ($ebookPopuler as $item)
                                        <div class="hero-ebook shadow mb-3">
                                            <img src="{{ asset('storage/' . $item->sampul) }}" alt="" class="img-fluid ebook-populer">
                                            <div class="hero-ebook-badges text-center">
                                                <a class="p-2 px-3" href="/ebook?kategori={{ $item->kategori->slug }}">{{ $item->kategori->nama }}</a>
                                            </div>
                                            <div class="hero-ebook-content">
                                                <div class="row d-flex justify-content-center align-items-center">
                                                    <div class="col-lg-9 text-break py-1">
                                                        <h5 class="mb-1" style="text-overflow:ellipsis; overflow:hidden;"><a href="/ebook/{{ $item->slug }}" class="text-decoration-none">{{ $item->judul }}</a></h5>
                                                        <h6 class="mt-1 ms-1">{{ $item->dilihat }} x dilihat &#183; <span>{{$item->created_at->diffForHumans()}}</span></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="bg-light px-3 mt-3 author-wrapper rounded-1 shadow">
                                <div class="row heading-wrapper ps-2 mb-3">
                                    <h4 class="aside-heading pt-2">Kategori Terpopuler<i class="fa-solid fa-thumbs-up position-relative float-end"></i></h4>
                                </div>
                                <div class="badges w-100">
                                    @foreach ($semuaKategori as $item)
                                        <a href="/ebook?kategori={{ $item->slug }}">{{ $item->nama }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </aside>
                    @endif
                </div>
            </div>
        </section>
    @endif
@endsection