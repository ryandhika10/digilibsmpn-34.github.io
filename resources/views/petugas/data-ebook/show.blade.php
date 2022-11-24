        @if ($show)
            <div class="modal fade show" id="modal-default" style="display: block; padding-right: 16px;">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Lihat E-Book</h4>
                            <span wire:click="format" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </span>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="justify-content-center row">
                                        <img src="/storage/{{ $sampul }}" alt="{{ $judul }}" width="250", height="350">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <table class="table text-nowrap">
                                        <tbody>
                                            <tr>
                                                <th>Judul</th>
                                                <td>:</td>
                                                <td>{{ $judul }}</td>
                                            </tr>
                                            <tr>
                                                <th>Penulis</th>
                                                <td>:</td>
                                                <td>{{ $penulis }}</td>
                                            </tr>
                                            <tr>
                                                <th>Penerbit</th>
                                                <td>:</td>
                                                <td>{{ $penerbit }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tempat Terbit</th>
                                                <td>:</td>
                                                <td>{{ $tempat_terbit }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tahun Terbit</th>
                                                <td>:</td>
                                                <td>{{ $tahun_terbit }}</td>
                                            </tr>
                                            <tr>
                                                <th>Kategori</th>
                                                <td>:</td>
                                                <td>{{ $kategori }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                </div>
                                <div class="col-md-7">
                                    <div class="justify-content-center">
                                        @if ($file == null)
                                            <small class="badge rounded-pill bg-danger">Tidak Ada File</small>
                                        @else
                                            <td><a href="/storage/{{ $file }}" target="_blank"><button class="btn btn-md btn-info ronded-3 text-white" type="button"><i class="fa-solid fa-folder-open"></i> Buka File</button></a></td>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <span wire:click="format" type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif