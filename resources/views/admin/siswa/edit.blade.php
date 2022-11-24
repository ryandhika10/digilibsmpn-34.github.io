        @if ($edit)
            <div class="modal fade show" id="modal-default" style="display: block; padding-right: 17px;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Siswa</h4>
                            <span wire:click="format" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </span>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nis">NIS</label>
                                <input wire:model="nis" type="text" class="form-control @error('nis') is-invalid @enderror" id="nis">
                                @error('nis') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input wire:model="nama" type="text" class="form-control @error('nama') is-invalid @enderror" id="nama">
                                @error('nama') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <input wire:model="kelas" type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas">
                                @error('kelas') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <span wire:click="format" type="button" class="btn btn-secondary" data-dismiss="modal">Batal</span>
                            <span wire:click="update({{ $siswa_id }})" type="button" class="btn btn-success">Update</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif