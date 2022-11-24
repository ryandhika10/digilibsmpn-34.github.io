<div class="row">
    <div class="col-12">

        @include('layouts/flash')

        @include('petugas/kategori/create')
        @include('petugas/kategori/import')
        @include('petugas/kategori/edit')

        <div class="btn-group mb-3">
            @role('admin|petugas')
                <button wire:click="format" class="btn btn-sm bg-teal mr-2">Semua</button>
                <button wire:click="buku" class="btn btn-sm bg-fuchsia mr-2">Buku</button>
                <button wire:click="ebook" class="btn btn-sm bg-olive mr-2">E-Book</button>
            @endrole
        </div>

        <div class="card">
            <div class="card-header">
                @if ($buku || $ebook || Auth::user()->hasRole(['guru','siswa','alumni']))
                    @if ($buku || $ebook || Auth::user()->hasRole(['guru']))
                        <span wire:click="create" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i> Tambah</span>
                    @endif
                @else
                    <span wire:click="import" class="btn btn-sm bg-indigo"><i class="fa-solid fa-file-import"></i>  Import Data</span>
                    <span wire:click="export" class="btn btn-sm bg-maroon ml-2"><i class="fa-solid fa-file-export"></i>  Export Data</span>
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
            <div wire:loading.delay wire:target="search" class="card w-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <strong>Loading...</strong>
                        <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            @if ($kategori->isNotEmpty())
                <div wire:loading.class="invisible" class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width = '10%'>No</th>
                                <th width = '20%'>Nama</th>
                                <th width = '15%'>Kategori</th>
                                @if ($buku || $ebook || Auth::user()->hasRole(['guru']))
                                    <th width = '15%'>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $item)
                                <tr>
                                    <td>{{ ($kategori->currentPage() - 1)  * $kategori->links()->paginator->perPage() + $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>
                                        @if ($item->jenis_kategori_id == 1)
                                            <span class="badge bg-fuchsia">Buku</span>
                                        @elseif($item->jenis_kategori_id == 2)
                                            <span class="badge bg-olive">E-Book</span>
                                        @elseif($item->jenis_kategori_id == 3)
                                            <span class="badge bg-purple">Blog</span>
                                        @endif
                                    </td>
                                    @if ($buku || $ebook || Auth::user()->hasRole(['guru']))
                                        <td>
                                            <div class="btn-group">
                                                <span wire:click= "edit({{ $item->id }})" class="btn btn-sm btn-primary mr-2"><i class="fa-solid fa-pen-to-square"></i> Edit</span>            
                                                <span wire:click.prevent="deleteConfirmation({{ $item->id }})" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i> Hapus</span>
                                            </div>
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
            {{ $kategori->links() }}
        </div>

        @if ($kategori->isEmpty())
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