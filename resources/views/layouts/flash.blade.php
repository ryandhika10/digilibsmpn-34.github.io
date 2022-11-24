@if (session('sukses'))
    <div class="alert alert-success" role="alert">
        {{ session('sukses') }}
    </div>
@endif
@if (session('gagal'))
    <div class="alert alert-danger" role="alert">
        {{ session('gagal') }}
    </div>
@endif