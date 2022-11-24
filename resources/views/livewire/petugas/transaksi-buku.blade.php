<div class="row">
    <div class="col-12">

        @include('layouts/flash')

        <div class="btn-group mb-3">
            <button wire:click="format" class="btn btn-sm bg-teal mr-2">Semua</button>
            <button wire:click="belumDipinjam" class="btn btn-sm bg-indigo mr-2">Belum Dipinjam</button>
            <button wire:click="sedangDipinjam" class="btn btn-sm bg-olive mr-2">Sedang Dipinjam</button>
            <button wire:click="selesaiDipinjam" class="btn btn-sm bg-fuchsia mr-2">Selesai Dipinjam</button>
        </div>

        <div class="card">
            <div class="card-header">
                @if ($selesai_dipinjam)
                    <span wire:click="export" class="btn btn-sm bg-orange text-white"><i class="fa-solid fa-file-export"></i>  Export Data</span>
                @endif
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input wire:model="search" type="search" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default bg-secondary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div wire:loading.delay class="card w-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <strong>Loading...</strong>
                        <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            @if ($transaksi->isNotEmpty())
                <div wire:loading.class="invisible" class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width = '10%'>No</th>
                                <th>Kode Pinjam</th>
                                <th>Buku</th>
                                <th>Lokasi</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Denda</th>
                                <th>Status</th>
                                @if (!$selesai_dipinjam)
                                    <th width = '15%'>Aksi</th>
                                @else

                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode_pinjam }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($item->detail_peminjaman as $detail_peminjaman)
                                                <li>
                                                    {{ $detail_peminjaman->buku->judul }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($item->detail_peminjaman as $detail_peminjaman)
                                                <li>
                                                    {{ $detail_peminjaman->buku->rak->lokasi }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</td>
                                    <td>{{ $item->denda }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge bg-indigo">Belum Dipinjam </span>
                                        @elseif ($item->status == 2)
                                            <span class="badge bg-olive">Sedang Dipinjam</span>
                                        @else
                                            <span class="badge bg-fuchsia">Selesai Dipinjam</span>
                                        @endif
                                    </td>
                                    @if (!$selesai_dipinjam)
                                        <td>
                                            @if ($item->status == 1)
                                                <span wire:click= "pinjam({{ $item->id }})" class="btn btn-sm btn-success mr-2">Pinjam</span>     
                                            @elseif ($item->status == 2) 
                                                <span wire:click= "kembali({{ $item->id }})" class="btn btn-sm btn-primary mr-2">Kembali</span>     
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <div wire:loading.class="invisible" class="d-flex justify-content-center">
                {{ $transaksi->links() }}
            </div>

        @if ($transaksi->isEmpty())
            <div wire:loading.class="invisible" class="card">
                <div class="card-body">
                    <div class="alert alert-warning">
                        Anda tidak memiliki data
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<!-- /.row -->

