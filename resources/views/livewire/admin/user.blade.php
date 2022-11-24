<div class="row">
    <div class="col-12">

        @include('layouts/flash')

        @include('admin/user/create')
        @include('admin/user/edit')

        <div class="btn-group mb-3">
            <button wire:click="format" class="btn btn-sm bg-teal mr-2">Semua</button>
            @if (auth()->user()->hasRole('admin'))
                <button wire:click="admin" class="btn btn-sm bg-indigo mr-2">Admin</button>
            @endif
            <button wire:click="petugas" class="btn btn-sm bg-olive mr-2">Petugas</button>
            <button wire:click="siswa" class="btn btn-sm bg-fuchsia mr-2">Siswa</button>
            <button wire:click="guru" class="btn btn-sm bg-maroon mr-2">Guru</button>
            <button wire:click="alumni" class="btn btn-sm bg-lightblue mr-2">Alumni</button>
        </div>

        <div class="card">
            <div class="card-header">
                @if ($petugas || $siswa || $guru)
                    <span wire:click="create" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i> Tambah</span>
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
            @if ($user->isNotEmpty())
                <div wire:loading.class="invisible" class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width = '10%'>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                @if ($guru)
                                    <th>NIP</th>
                                @endif
                                @if ($siswa)
                                    <th>NIS</th>
                                @endif
                                @if ($admin || $petugas || $admin == false && $petugas == false && $siswa == false && $guru == false)
                                    <th>Kode</th>
                                @endif
                                <th>Role</th>
                                @if ($admin || $petugas || $siswa || $guru || $alumni)
                                    <th width='15%'>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                                <tr>
                                    <td>{{ ($user->currentPage() - 1)  * $user->links()->paginator->perPage() + $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>
                                        @if ($item->roles[0]->name == 'admin')
                                            <span class="badge bg-indigo">Admin</span>
                                        @elseif($item->roles[0]->name == 'petugas')
                                            <span class="badge bg-olive">Petugas</span>
                                        @elseif($item->roles[0]->name == 'siswa')
                                            <span class="badge bg-fuchsia">Siswa</span>
                                        @elseif($item->roles[0]->name == 'guru')
                                            <span class="badge bg-maroon">Guru</span>
                                        @elseif($item->roles[0]->name == 'alumni')
                                            <span class="badge bg-lightblue">Alumni</span>
                                        @endif
                                    </td>
                                    @if ($admin || $petugas || $siswa || $guru || $alumni)
                                        <td>
                                            @if ($item->roles[0]->name == 'siswa' && $siswa || $item->roles[0]->name == 'guru' && $guru || $item->roles[0]->name == 'petugas' && $petugas || $item->roles[0]->name == 'alumni' && $alumni)
                                                <span wire:click.prevent="deleteConfirmation({{ $item->id }})" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i> Hapus</span>
                                            @elseif($item->roles[0]->name == 'admin' && $admin)
                                                <span wire:click="edit({{ $item->id }})" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i> Edit</span>
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
            {{ $user->links() }}
        </div>

        @if ($user->isEmpty())
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


