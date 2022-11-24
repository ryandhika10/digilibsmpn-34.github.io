@if ($import)
    <div class="modal fade show" id="modal-default" style="display: block; padding-right: 17px;" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Import Excel</h4>
                    <span wire:click="format" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </span>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <label for="importExcel">File Excel</label>
                            <input wire:model="importExcel" type="file" class="form-control" id="importExcel"  min='1'>
                            <small>Note <b class="text-danger">*</b> : Type file harus .xls, .xlsx</small>
                            <br>
                            @error('importExcel') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <span wire:click="exampleTemplate" type ="button" class="btn btn-primary">Download Template</span>
                    @if ($errors->any())
                        <div class="card-body">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer justify-content-between">
                    <span wire:click="format" type="button" class="btn btn-secondary" data-dismiss="modal">Batal</span>
                    <span wire:click="simpanImport" type="button" class="btn btn-success">Simpan</span>
                </div>
            </div>
        </div>
    </div>
@endif