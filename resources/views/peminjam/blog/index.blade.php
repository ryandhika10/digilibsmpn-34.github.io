@extends('layouts/app')
@section('content')
    <!-- HERO SECTION -->
    <section class="hero-postingan">
        <div class="container">
            <div class="search-wrapper col-md-8 mx-auto mb-4" data-aos="fade-down">
                <h2 class="mb-1 justify-content-center text-center">{{ $titlePost }}</h2>
                <div class="row justify-content-center mb-2">
                    <div class="col-md-8">
                        <form action="/posts">
                            @if (request('kategori'))
                                <input type = "hidden" name = "kategori" value = "{{ request('kategori') }}">
                            @endif
                            
                            @if (request('user'))
                                <input type = "hidden" name = "user" value = "{{ request('user') }}">
                            @endif
                            
                            @if (request('tag'))
                                <input type = "hidden" name = "tag" value = "{{ request('tag') }}">
                            @endif
                            <div class="input-group mb-1">
                                <input type="text" class="form-control" placeholder="Cari: Judul, Konten, ..." name="search" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if ($posts->count())
                <div class="row justify-content-between heading-post">
                    <div class="col-lg-7 col-md-6 mx-auto">
                        <div class="hero-post first-img shadow">
                            @if ($posts[0]->sampul)
                                <a href="/posts/{{ $posts[0]->slug }}"><img src="{{ asset('storage/' . $posts[0]->sampul) }}" alt="{{ $posts[0]->kategori->nama }}" class="img-fluid"></a>
                            @else
                                <img src="https://source.unsplash.com/random/600x500?{{ $posts[0]->kategori->nama }}" class="img-fluid" alt="{{ $posts[0]->kategori->nama }}">
                            @endif
                            <div class="hero-post-badges text-center">
                                <a href="/posts?user={{ $posts[0]->user->username }}" class="text-decoration-none p-2 px-3 mb-2"> {{ $posts[0]->user->nama }}</a>
                                <a class="p-2 px-3" href="/posts?kategori={{ $posts[0]->kategori->slug }}">{{ $posts[0]->kategori->nama }}</a>
                            </div>
                            <div class="hero-post-content">
                                <div class="row d-flex justify-content-between align-items-center text-break">
                                    <div class="col-md-2">
                                        @if ($posts[0]->user->foto)
                                            <img src="{{ asset('storage/' . $posts[0]->user->foto) }}" alt="{{ $posts[0]->user->nama }}" class="img-fluid rounded-circle ms-2 my-1">
                                        @else
                                            <img src="/storage/foto-user/user.png" class="img-fluid rounded-circle bg-light ms-2 my-1" alt="{{ $posts[0]->user->nama }}">
                                        @endif
                                    </div>
                                    <div class="col-md-10">
                                        <h2><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none">{{ $posts[0]->judul }}</a></h2>
                                        @if ($posts[0]->tag->count())
                                            <span class="tag">Tag :</span>
                                            @foreach ($posts[0]->tag as $item)
                                                <a href="/posts?tag={{ $item->slug }}" class="text-decoration-none"><span class="badge rounded-pill me-1">{{ $item->nama }}</span></a>
                                            @endforeach
                                        @else
                                            <span class="tag">Tag :</span>
                                            <a href="#" class="text-decoration-none"><span class="badge rounded-pill me-1">None</span></a>
                                        @endif
                                        <br>
                                        <h6 class="mt-2">{{ $posts[0]->dilihat }} x dilihat &#183; <span>{{$posts[0]->created_at->diffForHumans()}}</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($posts->count() > 1)
                        <div class="col-lg-4 col-md-4 side-post">
                            @foreach ($posts->skip(1)->take(2) as $item)
                                <div class="hero-post second-img shadow mb-3">
                                    @if ($item->sampul)
                                        <a href="/posts/{{ $item->slug }}">
                                            <img src="{{ asset('storage/' . $item->sampul) }}" alt="{{ $item->kategori->nama }}" class="img-fluid">
                                        </a>
                                    @else
                                        <img src="https://source.unsplash.com/random/300x250?{{ $item->kategori->nama }}" class="img-fluid" alt="{{ $item->kategori->nama }}">
                                    @endif
                                    <div class="hero-post-badges text-center">
                                        <a href="/posts?user={{ $item->user->username }}" class="text-decoration-none p-2 px-3 mb-2"> {{ $item->user->nama }}</a>
                                        <a class="p-2 px-3" href="/posts?kategori={{ $item->kategori->slug }}">{{ $item->kategori->nama }}</a>
                                    </div>
                                    <div class="hero-post-content">
                                        <div class="row d-flex justify-content-between align-items-center">
                                            <div class="col-lg-3">
                                                @if ($item->user->foto)
                                                    <img src="{{ asset('storage/' . $item->user->foto) }}" alt="{{ $item->user->nama }}" class="img-fluid rounded-circle ms-2">
                                                @else
                                                    <img src="/storage/foto-user/user.png" class="img-fluid rounded-circle bg-light ms-2" alt="{{ $item->user->nama }}">
                                                @endif
                                            </div>
                                            <div class="col-lg-9 my-1">
                                                <h5 class="judul-kedua"><a href="/posts/{{ $item->slug }}" class="text-decoration-none">{{ $item->judul }}</a></h5>
                                                @if ($item->tag->count())
                                                    <span class="tag">Tag :</span>
                                                    @foreach ($item->tag->take(4) as $tag)
                                                        <a href="/posts?tag={{ $tag->slug }}" class="text-decoration-none"><span class="badge rounded-pill me-1">{{ $tag->nama }}</span></a>
                                                    @endforeach
                                                @else
                                                    <span class="tag">Tag :</span>
                                                    <a href="#" class="text-decoration-none"><span class="badge rounded-pill me-1">None</span></a>
                                                @endif
                                                <h6 class="mt-1 ms-1">{{ $item->dilihat }} x dilihat &#183; <span>{{$item->created_at->diffForHumans()}}</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @else
                <div class="row mt-5 justify-content-center text-center">
                    <div class="col-md-5">
                        <div class="alert alert-info" role="alert">
                            <h5>Tidak ada post ditemukan</h5>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- Blog Section -->
    @if ($posts->count() || $semuaKategori->count())
        <section class="blog-posts py-3">
            <div class="container">
                <div class="row">
                    @if ($posts->count())
                        <div class="col-md-8 blog-wrapper shadow rounded py-3">
                            @foreach ($posts->skip(3) as $item)
                                <article class="blog-post mb-3 shadow">
                                    <div class="row position-relative">
                                        <div class="col-sm-4">
                                            <img src="{{ asset('storage/' . $item->sampul) }}" alt="{{ $item->kategori->nama }}" class="img-fluid">
                                        </div>
                                        <div class="position-absolute top-0 kategori w-auto">
                                            <a href="/posts?kategori={{ $item->kategori->slug }}" class="text-decoration-none p-2 px-3 mb-2">{{ $item->kategori->nama }}</a>
                                        </div>
                                        <div class="col-sm-8">
                                            <h3 class="m-0 mt-2"><a href="/posts/{{ $item->slug }}" class="text-decoration-none">{{ $item->judul }}</a></h3>
                                            <h6 class="mt-2">Penulis:<a href="/posts?user={{ $item->user->username }}" class="text-decoration-none"> {{ $item->user->nama }}</a></h6>
                                            <p class="me-1 mb-1">{{ $item->kutipan }}</p>
                                            @if ($item->tag->count())
                                                <div class="badge">
                                                    <span class="tag">Tag :</span>
                                                    @foreach ($item->tag->take(3) as $tag)
                                                        <a href="/posts?tag={{ $tag->slug }}" class="text-decoration-none"><span class="me-1">{{ $tag->nama }}</span></a>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="tag">Tag :</span>
                                                <a href="#" class="text-decoration-none"><span class="badge rounded-pill me-1">None</span></a>
                                            @endif
                                            <small class="my-2 d-block">{{ $item->dilihat }} x dilihat &#183; <span>{{$item->created_at->diffForHumans()}}</span></small>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif
                    @if ($semuaKategori->count())
                        <aside class="col-md-4 px-4">
                            <div class="bg-light px-3 mt-3 mt-lg-0 author-wrapper rounded-1 shadow">
                                <div class="row heading-wrapper ps-2 mb-3">
                                    <h4 class="aside-heading pt-2">Kategori Terpopuler<i class="fa-solid fa-thumbs-up position-relative float-end"></i></h4>
                                </div>
                                <div class="badges w-100">
                                    @foreach ($semuaKategori->take(7) as $item)
                                        <a href="/posts?kategori={{ $item->slug }}">{{ $item->nama }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </aside>
                    @endif
                </div>
            </div>
        </section>
    @endif

    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>

@endsection