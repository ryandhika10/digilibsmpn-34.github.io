<div class="row">
    <div class="col-12">

        @include('layouts/flash')

        @include('petugas/data-buku/rak/create')
        @include('petugas/data-buku/rak/edit')

        <div class="card">
            <div class="card-header">
                <span wire:click="create" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i> Tambah</span>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <select wire:model="search" class="form-control float-right" aria-label="Default select example">
                            @foreach ($count as $item)
                                <option value="{{ $item->rak }}">{{ $item->rak }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button wire:click="formatSearch" type="submit" class="btn btn-default bg-secondary">
                                <i class="fa-solid fa-xmark"></i>
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
            @if ($raks->isNotEmpty())
                <div wire:loading.class="invisible" class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width = '10%'>No</th>
                                <th>Rak</th>
                                <th>Baris</th>
                                <th>Kategori</th>
                                <th width = '15%'>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($raks as $item)
                                <tr>
                                    <td>{{ ($raks->currentPage() - 1)  * $raks->links()->paginator->perPage() + $loop->iteration }}</td>
                                    <td>{{ $item->rak }}</td>
                                    <td>{{ $item->baris }}</td>
                                    <td>{{ $item->kategori->nama }}</td>
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
                {{ $raks->links() }}
            </div>

        @if ($raks->isEmpty())
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
