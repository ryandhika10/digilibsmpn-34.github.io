        @if ($edit)
            <div class="modal fade show" id="modal-default" style="display: block; padding-right: 17px;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Rak</h4>
                            <span wire:click="format" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </span>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="rak">Rak</label>
                                <input wire:model="rak" type="number" class="form-control @error('rak') is-invalid @enderror" id="rak"  min='1'>
                                @error('rak') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="baris">Baris</label>
                                <input wire:model="baris" type="number" class="form-control @error('baris') is-invalid @enderror" id="baris"  min='1'>
                                @error('baris') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select wire:model="kategori_id" type="number" class="form-control @error('kategori_id') is-invalid @enderror" id="kategori">
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_id') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <span wire:click="format" type="button" class="btn btn-secondary" data-dismiss="modal">Batal</span>
                            <span wire:click="update({{ $rak_id }})" type="button" class="btn btn-success">Update</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif