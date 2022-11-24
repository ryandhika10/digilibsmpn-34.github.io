@extends('layouts/dashboard/main')
@section('title', 'Tambah Post')
@section('active-d-post', 'active')
@section('active-data-blog', 'active')
@section('collapse-data-blog', 'menu-is-opening menu-open')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="/d-blog" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body table-responsive">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Post</label>
                            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}">
                            @error('judul')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}">
                            @error('slug')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sampul" class="form-label">Sampul</label>
                            <img class="sampul-preview img-fluid mb-3 col-sm-3">
                            <input type="file" class="form-control" id="sampul" name="sampul" onchange="previewImage()">
                            @error('sampul')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control selectpicker" title="Pilih Kategori" data-live-search="true">
                                @foreach ($kategori as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tag" class="form-label">Tag</label>
                            <select multiple name="tag[]" id="tag" class="form-control selectpicker" title="Pilih Tag" data-live-search = "true">
                                @foreach ($tag as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                @endforeach
                            </select>
                            @error('tag')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="konten" class="form-label">Konten</label>
                            <input type="hidden" name="konten" id="konten" value="{{ old('konten') }}">
                            <trix-editor input="konten"></trix-editor>
                        
                            @error('konten')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="btn-group" role="group">
                            <a href="/d-blog" class="btn btn-danger mr-md-3 mr-sm-2">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const judul = document.querySelector('#judul');
        const slug = document.querySelector('#slug');
        judul.addEventListener('change',function(){
            fetch('/d-blogs/checkSlug?judul=' + judul.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });

        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        })
        
        function previewImage() {
            const sampul = document.querySelector('#sampul');
            const imgPreview = document.querySelector('.sampul-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(sampul.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection