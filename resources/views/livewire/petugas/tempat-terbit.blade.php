<div class="row">
    <div class="col-12">

        @include('layouts/flash')

        @include('petugas/tempat-terbit/create')
        @include('petugas/tempat-terbit/import')
        @include('petugas/tempat-terbit/edit')

        <div class="card">
            <div class="card-header">
                <span wire:click="create" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i> Tambah</span>
                <span wire:click="import" class="btn btn-sm bg-indigo ml-5"><i class="fa-solid fa-file-import"></i>  Import Data</span>
                <span wire:click="export" class="btn btn-sm bg-maroon ml-2"><i class="fa-solid fa-file-export"></i>  Export Data</span>

                
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
            @if ($tempatTerbit->isNotEmpty())
                <div wire:loading.class="invisible" class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width = '10%'>No</th>
                                <th>Tempat Terbit</th>
                                <th width = '15%'>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tempatTerbit as $item)
                                <tr>
                                    <td>{{ ($tempatTerbit->currentPage() - 1)  * $tempatTerbit->links()->paginator->perPage() + $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
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
            {{ $tempatTerbit->links() }}
        </div>

        @if ($tempatTerbit->isEmpty())
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