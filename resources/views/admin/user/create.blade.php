        @if ($create)
            <div class="modal fade show" id="modal-default" style="display: block; padding-right: 17px;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah User</h4>
                            <span wire:click="format" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </span>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input autofocus wire:model="nama" type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama">
                                @error('nama') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                            @if ($siswa)
                                <div class="form-group">
                                    <label for="nis">NIS</label>
                                    <input wire:model="nis" type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" placeholder="NIS">
                                    @error('nis') 
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div> 
                                    @enderror
                                </div>
                            @elseif ($admin || $petugas)
                                <div class="form-group">
                                    <label for="kode">Kode</label>
                                    <input wire:model="kode" type="text" class="form-control @error('kode') is-invalid @enderror" id="kode" placeholder="Kode">
                                    @error('kode') 
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div> 
                                    @enderror
                                </div>
                            @elseif($guru)
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input wire:model="nip" type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" placeholder="NIP">
                                    @error('nip') 
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div> 
                                    @enderror
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input wire:model="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Alamat Email">
                                @error('email') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input wire:model="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                                @error('password') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <span wire:click="format" type="button" class="btn btn-secondary" data-dismiss="modal">Batal</span>
                            <span wire:click="store" type="button" class="btn btn-success">Simpan</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif