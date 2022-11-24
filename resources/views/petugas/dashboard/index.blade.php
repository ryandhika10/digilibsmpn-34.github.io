@extends('layouts/dashboard/main')
@section('title', 'Dashboard')
@section('active-dashboard', 'active')
@section('content')
    <section class="dashboard-admin" id="dashboard-admin">
        @role('petugas|admin')
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $count_buku }}</h3>
                            <p>Buku</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-book"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-fuchsia">
                        <div class="inner">
                            <h3>{{ $count_ebook }}</h3>
                            <p>E-Book</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-book-atlas"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-orange">
                        <div class="inner">
                            <h3 class="text-white ">{{ $count_siswa }}</h3>
                            <p class="text-white">Siswa</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-user-graduate"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $count_guru }}</h3>
                            <p>Guru</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 class="text-white">{{ $count_selesai_dipinjam }}</h3>
                            <p class="text-white">Selesai Pinjam</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $count_sedang_dipinjam }}</h3>
                            <p>Sedang Dipinjam</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card border border-top-0 border-end-0 border-bottom-0 border-5 border-info">
                        <div class="card-body">
                            <h5>Buku Terbaru</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Judul</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($buku as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->judul }}</td>
                                            <td>{{ $item->created_at->diffforHumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border border-top-0 border-end-0 border-bottom-0 border-5 border-ebook">
                        <div class="card-body">
                            <h5>E-Book Terbaru</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Judul</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ebook as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->judul }}</td>
                                            <td>{{ $item->created_at->diffforHumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card border border-top-0 border-end-0 border-bottom-0 border-5 border-siswa">
                        <div class="card-body">
                            <h5>Siswa Terbaru</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswa as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->created_at->diffforHumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border border-top-0 border-end-0 border-bottom-0 border-5 border-success">
                        <div class="card-body">
                            <h5>Guru Terbaru</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($guru as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->created_at->diffforHumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card border border-top-0 border-end-0 border-bottom-0 border-5 border-warning">
                        <div class="card-body">
                            <h5>Selesai Dipinjam</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Kode Pinjam</th>
                                        <th>Tanggal Pengembalian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($selesai_dipinjam as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode_pinjam }}</td>
                                            <td>{{ Carbon\Carbon::parse($item->tanggal_pengembalian)->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border border-top-0 border-end-0 border-bottom-0 border-5 border-danger">
                        <div class="card-body">
                            <h5>Sedang Dipinjam</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Kode Pinjam</th>
                                        <th>Tanggal Pinjam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sedang_dipinjam as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode_pinjam }}</td>
                                            <td>{{ Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endrole
        @role('guru|siswa|alumni')
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $count_post }}</h3>
                            <p>Post</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-paper-plane"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-fuchsia">
                        <div class="inner">
                            <h3>{{ $count_kategori }}</h3>
                            <p>Kategori</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-border-all"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-orange">
                        <div class="inner">
                            <h3 class="text-white ">{{ $count_tag }}</h3>
                            <p class="text-white">Tag</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-tags"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border border-top-0 border-end-0 border-start-0 border-5 border-primary shadow dashboard-post">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Post Terbaru</h6>
                </div>
                <div class="card-body">
                    @if ($post->count() >= 1)
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Sampul</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Tag</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($post as $row)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td><img src="{{ asset('storage/' . $row->sampul)  }}" alt="" width="80px" height="80px"></td>
                                        <td>{{ $row->judul }}</td>
                                        <td>{{ $row->kategori->nama }}</td>
                                        <td>
                                            @foreach ($row->tag as $post_tag)
                                                <span class="badge badge-secondary">{{ $post_tag->nama }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info" role="alert">
                            Anda tidak memiliki post terbaru hari ini
                        </div>
                    @endif
                </div>
            </div>

            {{-- kategori --}}
            <div class="card border border-top-0 border-end-0 border-start-0 border-5 border-ebook shadow dashboard-post">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-fuchsia">Kategori Terbaru</h6>
                </div>
                <div class="card-body">
                    @if ($kategori->count() >= 1)
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Slug</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategori as $row)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $row->nama }}</td>
                                        <td>{{ $row->slug }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info" role="alert">
                            Anda tidak memiliki kategori terbaru hari ini
                        </div>
                    @endif
                </div>
            </div>

            {{-- tag --}}
            <div class="card border border-top-0 border-end-0 border-start-0 border-5 border-siswa shadow dashboard-post">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-orange">Tag Terbaru</h6>
                </div>
                <div class="card-body">
                    @if ($tag->count() >= 1)
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tag</th>
                                    <th scope="col">Slug</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tag as $row)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $row->nama }}</td>
                                        <td>{{ $row->slug }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info" role="alert">
                            Anda tidak memiliki tag terbaru hari ini
                        </div>
                    @endif
                </div>
            </div>

        @endrole
    </section>
@endsection