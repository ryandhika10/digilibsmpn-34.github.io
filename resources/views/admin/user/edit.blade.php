        @if ($edit)
            <div class="modal fade show" id="modal-default" style="display: block; padding-right: 17px;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit User</h4>
                            <span wire:click="format" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </span>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input autofocus wire:model="nama" type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"  min='1' placeholder="Nama">
                                @error('nama') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="kode">Kode</label>
                                <input autofocus wire:model="kode" type="number" class="form-control @error('kode') is-invalid @enderror" id="kode"  min='1' placeholder="Kode">
                                @error('kode') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input autofocus wire:model="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email"  min='1' placeholder="Alamat Email">
                                @error('email') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input autofocus wire:model="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password"  min='1' placeholder="Password">
                                @error('password') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <span wire:click="format" type="button" class="btn btn-secondary" data-dismiss="modal">Batal</span>
                            <span wire:click="update({{ $user_id }})" type="button" class="btn btn-success">Update</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif