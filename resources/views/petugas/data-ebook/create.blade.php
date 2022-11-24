@if ($create)
    <div class="modal fade show" id="modal-default" style="display: block; padding-right: 17px;">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah E-Book</h4>
                    <span wire:click="format" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </span>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input wire:model="judul" type="text" class="form-control @error('judul') is-invalid @enderror" id="judul">
                        @error('judul') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div> 
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="penulis">Penulis</label>
                                <input wire:model="penulis" type="text" class="form-control @error('penulis') is-invalid @enderror" id="penulis">
                                @error('penulis') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tahun_terbit">Tahun Terbit</label>
                                <input wire:model="tahun_terbit" type="text" class="form-control @error('tahun_terbit') is-invalid @enderror" id="tahun_terbit">
                                @error('tahun_terbit') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="penerbit">Tempat Terbit</label>
                                <select wire:model="tempat_terbit_id" type="number" class="form-control @error('tempat_terbit_id') is-invalid @enderror" id="tempat_terbit">
                                    <option selected value="">Pilih Tempat Terbit</option>
                                    @foreach ($tempat_terbit as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('tempat_terbit_id') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sampul">Sampul</label>
                                <input wire:model="sampul" type="file" class="form-control @error('sampul') is-invalid @enderror" id="sampul"  min='1'>
                                @error('sampul') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="file">File E-Book</label>
                                <input wire:model="file" type="file" class="form-control @error('file') is-invalid @enderror" id="file"  min='1'>
                                @error('file') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select wire:model="kategori_id" type="number" class="form-control @error('kategori_id') is-invalid @enderror" id="kategori">
                                    <option selected value="">Pilih Kategori</option>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="penerbit">Penerbit</label>
                                <select wire:model="penerbit_id" type="number" class="form-control @error('penerbit_id') is-invalid @enderror" id="penerbit">
                                    <option selected value="">Pilih Penerbit</option>
                                    @foreach ($penerbit as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('penerbit_id') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>
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