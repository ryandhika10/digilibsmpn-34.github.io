@extends('layouts/dashboard/main')
@section('title', 'Edit Post')
@section('active-d-post', 'active')
@section('active-data-blog', 'active')
@section('collapse-data-blog', 'menu-is-opening menu-open')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="/d-blog/{{ $post->slug }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card">
                    <div class="card-body table-responsive">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Post</label>
                            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') ? old('judul') : $post->judul }}">
                            @error('judul')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $post->slug) }}">
                            @error('slug')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-12">
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
                                    <select name="kategori_id" id="kategori" class="form-control selectpicker" data-live-search="true">
                                        @foreach ($kategori as $row)
                                            @if ($row->id == $post->kategori_id)
                                                <option title="{{ $row->nama }}" value="{{ $row->id }}">{{ $row->nama }}</option>
                                            @endif
                                        @endforeach
                                        @foreach ($kategori as $row)
                                            @if ($row->id != $post->kategori_id)
                                                <option title="{{ $row->nama }}" value="{{ $row->id }}">{{ $row->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('kategori')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="tag" class="form-label">Tag</label>
                            <select multiple name="tag[]" id="tag" class="form-control selectpicker" title="Pilih Tag" data-live-search = "true">
                                @foreach ($tag as $row)
                                    <option value="{{ $row->id }}"
                                        @foreach ($post->tag as $tag_lama)
                                            @if ($tag_lama->id == $row->id)
                                                selected
                                            @endif
                                        @endforeach
                                        >{{ $row->nama }}</option>
                                @endforeach
                            </select>
                            @error('tag')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="konten" class="form-label">Konten</label>
                            <input type="hidden" name="konten" id="konten" value="{{ old('konten', $post->konten) }}">
                            <trix-editor input="konten"></trix-editor>
                        
                            @error('konten')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                            <a href="/d-blog" class="btn btn-danger mr-md-3 mr-sm-2">Kembali</a>
                            <button type="submit" class="btn btn-success">Update</button>
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