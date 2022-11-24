@extends('layouts/dashboard/main')
@section('title', 'Post')
@section('active-d-post', 'active')
@section('active-data-blog', 'active')
@section('collapse-data-blog', 'menu-is-opening menu-open')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('layouts/flash')

            <div class="card">
                <div class="card-header">
                    <a href="/d-blog/create" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i> Tambah</a>

                    <div class="card-tools">
                        <form action="/d-blog/search" method="POST">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                @csrf
                                <input type="search" name="search" class="form-control float-right" placeholder="Search" value="{{ $search ? $search : '' }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default bg-secondary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                @if ($post->isNotEmpty())
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th width = '10%'>No</th>
                                    <th>Sampul</th>
                                    <th width = '20%'>Judul</th>
                                    <th>Kategori</th>
                                    <th>Tag</th>
                                    <th width = '35%'>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($post as $item)
                                    <tr class="text-break">
                                        <td>{{ ($post->currentPage() - 1)  * $post->links()->paginator->perPage() + $loop->iteration }}</td>
                                        <td><img src="/storage/{{ $item->sampul }}" alt="{{ $item->judul }}" width="60" height="80"></img></td>
                                        <td width="20%" class="text-wrap">{{ $item->judul }}</td>
                                        <td>{{ $item->kategori->nama }}</td>
                                        <td class="text-wrap">
                                            @if ($item->tag->count() >= 1)
                                                @foreach ($item->tag as $tag)
                                                    <span class="badge badge-secondary">{{ $tag->nama }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge badge-secondary">None</span>
                                            @endif
                                        </td>
                                        <td width="35%">
                                            <div class="btn-group">
                                                <a href="d-blog/{{ $item->id }}/rekomendasi" class="btn btn-warning btn-sm mr-1"><i class="{{ $item->rekomendasi ? 'fa-solid fa-star' : 'fa-regular fa-star' }}"></i> Rekomendasi</a>
                                                <a href="d-blog/{{ $item->slug }}" class="btn btn-info btn-sm mr-1"><i class="fa-solid fa-eye"></i> Detail</a>
                                                <a href="d-blog/{{ $item->slug }}/edit" class="btn btn-primary btn-sm mr-1"><i class="fa-solid fa-edit"></i> Edit</a>
                                                <a href="/d-blog/{{ $item->id }}/konfirmasi" class="btn btn-danger btn-sm mr-1"><i class="fa-solid fa-trash-can"></i> Hapus</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="item justify-content-center">
                {{ $post->links() }}
            </div>
            @if ($post[0] == false)
                @if ($session)
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-warning">
                                {{ $session }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-warning">
                                Anda tidak memiliki data
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
<!-- /.item -->


@endsection