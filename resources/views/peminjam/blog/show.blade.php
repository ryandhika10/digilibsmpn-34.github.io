@extends('layouts/app')
@section('content')
    <!-- Blog Section -->
    @if ($post->count() || $semuaKategori->count())
        <section class="detail-post py-3">
            <div class="container">
                <div class="row mt-md-3 mt-lg-0">
                    @if ($semuaKategori->count())
                        <div class="col-md-8 konten-post rounded shadow position-relative pb-3" style="height: 100%">
                            <div class="mb-3 kembali">
                                <a href="/posts" class="btn"><i class="fa-solid fa-arrow-left"></i> Kembali ke Semua Postingan</a>
                            </div>
                            <div class="hero-post detail-img shadow">
                                @if ($post->sampul)
                                    <img src="{{ asset('storage/' . $post->sampul) }}" alt="{{ $post->kategori->nama }}" class="img-fluid">
                                @else
                                    <img src="https://source.unsplash.com/random/600x500?{{ $post->kategori->nama }}" class="img-fluid" alt="{{ $post->kategori->nama }}">
                                @endif
                                <div class="hero-post-badges text-center">
                                    <a href="/posts?user={{ $post->user->username }}" class="text-decoration-none p-2 px-3 mb-2"> {{ $post->user->nama }}</a>
                                    <a class="p-2 px-3" href="/posts?kategori={{ $post->kategori->slug }}">{{ $post->kategori->nama }}</a>
                                </div>
                                <div class="hero-post-content">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 py-1">
                                            @if ($post->user->foto)
                                                <img src="{{ asset('storage/' . $post->user->foto) }}" alt="{{ $post->user->nama }}" class="img-fluid rounded-circle ms-2">
                                            @else
                                                <img src="/storage/foto-user/user.png" class="img-fluid rounded-circle bg-light ms-2" alt="{{ $post->user->nama }}">
                                            @endif
                                        </div>
                                        <div class="col-md-10 text-break judul-show">
                                            <h2 class="me-2">{{ $post->judul }}</h2>
                                            @if ($post->tag->count())
                                                <div class="mb-2">
                                                    <span class="tag">Tag :</span>
                                                    @foreach ($post->tag as $item)
                                                        <a href="/posts?tag={{ $item->slug }}" class="text-decoration-none"><span class="badge rounded-pill me-1">{{ $item->nama }}</span></a>
                                                    @endforeach
                                                </div>
                                                <h6 class="mt-2">{{ $post->dilihat }} x dilihat &#183; <span>{{$post->created_at->format('d F Y')}}</span></h6>
                                            @else
                                                <div class="mb-2">
                                                    <span class="tag">Tag :</span>
                                                    <a href="#" class="text-decoration-none"><span class="badge rounded-pill me-1">None</span></a>
                                                </div>
                                                <h6 class="mt-2">{{ $post->dilihat }} x dilihat &#183; <span>{{$post->created_at->format('d F Y')}}</span></h6>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-content p-4 text-break">
                                {!! $post->konten !!}
                            </div>
                            <div class="btn-group mx-4 like_komen">
                                <a href="/posts/like/{{ $post->slug }}" class="btn btn-outline-danger" role="button"><i class="fa-solid fa-heart"></i> {{ $like }} Suka</a>
                                <button id="btn-komentar-utama" href="" class="btn btn-outline-primary"><i class="fa-regular fa-comment"></i> Komentar</button>
                            </div>
                            <form action="" method="post" class="mx-4 mb-4" id="komentar-utama" style="display: none;">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <input type="hidden" name="parent" value="0">
                                <textarea class="form-control" name="konten" placeholder="Tambahkan komentar..." style="height: 100px;"></textarea>
                                <input type="submit" value="Kirim" class="btn btn-primary mt-2">
                            </form>
                            @foreach ($post->komentar()->where('parent', 0)->orderBy('created_at','desc')->get() as $komentar)
                                <div class="row mx-4 my-3 border-bottom">
                                    <div class="col-md-1">
                                        <img src="{{ $komentar->user->getFoto() }}" alt="{{ $komentar->user->nama() }}" class="img-fluid rounded-circle">
                                    </div>
                                    <div class="col-md-11">
                                        <p> <a href="#">{{ $komentar->user->nama() }}</a><br>{{ $komentar->konten }} <br> <span class="text-muted"> {{ $komentar->created_at->diffForHumans() }}</span></p>
                                        <form action="" method="post">
                                            @csrf
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                            <input type="hidden" name="parent" value="{{ $komentar->id }}">
                                            <input type="text" name="konten" class="form-control" placeholder="Tambahkan komentar..." id="">
                                            <input type="submit" class="btn btn-primary btn-xs my-2" value="Kirim">
                                        </form>
                                        @foreach ($komentar->childs()->orderBy('created_at','desc')->get() as $child)
                                            <p> <a href="#">{{ $child->user->nama() }}</a> {{ $child->konten }} <br> <span class="text-muted mb-2"> {{ $child->created_at->diffForHumans() }}</span></p>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if ($semuaKategori->count())
                        <aside class="col-md-4 px-4">
                            @if ($postPopuler->count())
                                <div class="bg-light px-3 author-wrapper post-populer-wrapper rounded-1 pb-2 shadow">
                                    <div class="row heading-wrapper ps-2 mb-3">
                                        <h4 class="aside-heading pt-2">Postingan Terpopuler<i class="fa-solid fa-crown position-relative float-end"></i></h4>
                                    </div>
                                    @foreach ($postPopuler as $item)
                                        <div class="hero-post shadow mb-3">
                                            <img src="{{ asset('storage/' . $item->sampul) }}" alt="" class="img-fluid post-populer">
                                            <div class="hero-post-badges text-center">
                                                <a class="p-2 mb-2" href="/posts?user={{ $item->user->username }}">{{ $item->user->nama }}</a>
                                                <a class="p-2 px-3" href="/posts?kategori={{ $item->kategori->slug }}">{{ $item->kategori->nama }}</a>
                                            </div>
                                            <div class="hero-post-content">
                                                <div class="row d-flex justify-content-center align-items-center">
                                                    <div class="col-lg-3 ps-3 py-1">
                                                        @if ($item->user->foto)
                                                            <img src="{{ asset('storage/' . $item->user->foto) }}" alt="{{ $item->user->nama }}" class="img-fluid rounded-circle ms-2">
                                                        @else
                                                            <img src="/storage/foto-user/user.png" class="img-fluid rounded-circle bg-light ms-2" alt="{{ $item->user->nama }}">
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-9 text-break">
                                                        <h5 class="mb-1" style="text-overflow:ellipsis; overflow:hidden;"><a href="/posts/{{ $item->slug }}" class="text-decoration-none">{{ $item->judul }}</a></h5>
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
                            <div class="bg-light px-3 mt-3 author-wrapper rounded-1 shadow">
                                <div class="row heading-wrapper ps-2 mb-3">
                                    <h4 class="aside-heading pt-2">Kategori Terpopuler<i class="fa-solid fa-thumbs-up position-relative float-end"></i></h4>
                                </div>
                                <div class="badges w-100">
                                    @foreach ($semuaKategori as $item)
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
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#btn-komentar-utama').click(function(){
                $('#komentar-utama').toggle('slide');
            });
        });
    </script>
@endsection