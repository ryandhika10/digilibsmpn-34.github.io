<div class="row">
    <div class="col-12">

        @include('layouts/flash')

        @include('admin/siswa/create')
        @include('admin/siswa/import')
        @include('admin/siswa/edit')

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <span wire:click="create" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i> Tambah</span>
                        <span wire:click="import" class="btn btn-sm bg-indigo ml-5"><i class="fa-solid fa-file-import"></i>  Import Data</span>
                        <span wire:click="export" class="btn btn-sm bg-fuchsia ml-2"><i class="fa-solid fa-file-export"></i>  Export Data</span>
                    </div>
                    <div class="col-md-2">
                        <span wire:click.prevent="deleteAllConfirmation()" class="btn btn-sm bg-danger"><i class="fa-solid fa-trash-can-arrow-up"></i> Hapus Semua</span>
                    </div>
                    <div class="col-md-2 d-flex justify-content-md-end align-items-md-end">
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
            @if ($siswa->isNotEmpty())
                <div wire:loading.class="invisible" class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width = '10%'>No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th width = '15%'>Akun</th>
                                <th width = '15%'>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $item)
                                <tr>
                                    <td>{{ ($siswa->currentPage() - 1)  * $siswa->links()->paginator->perPage() + $loop->iteration }}</td>
                                    <td>{{ $item->nis }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kelas }}</td>
                                    <td>
                                        @if (isset($item->user->kode))
                                            <span class="badge bg-fuchsia">Sudah ada</span>
                                        @else
                                            <span class="badge bg-secondary">Belum ada</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">    
                                            <span wire:click= "edit({{ $item->id }})" class="btn btn-sm btn-primary mr-2"><i class="fa-solid fa-pen-to-square"></i> Edit</span>      
                                            <span wire:click.prevent="deleteConfirmation({{ $item->id }})" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i> Hapus</span>
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

        <div wire:loading.class="invisible" class="d-flex justify-content-center">
            {{ $siswa->links() }}
        </div>

        @if ($siswa->isEmpty())
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

