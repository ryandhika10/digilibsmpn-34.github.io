<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts/dashboard/header')
    @livewireStyles
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('layouts/dashboard/navbar')
        @include('layouts/dashboard/sidebar')
        <div class="content-wrapper">
            @include('layouts/dashboard/main-header')
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>
        @include('layouts/footer')
        <aside class="control-sidebar control-sidebar-dark">

        </aside>
    </div>

    @include('layouts/dashboard/javascript')

    @yield('script')
    @livewireScripts
    {{-- Sweet Alert --}}
        <script>
            Livewire.on('success', data => {
                Swal.fire({
                    title: 'Sukses',
                    text: data.pesan,
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
            });
        </script>
        <script>
            Livewire.on('failed', data => {
                Swal.fire({
                    title: 'Gagal',
                    text: data.pesan,
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
            });
        </script>
        <script>
            window.addEventListener('show-konfirmasi-hapus', event => {
                Swal.fire({
                    title: 'Peringatan !',
                    title: 'Anda yakin menghapus data ?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3086d6',
                    cancelButtonColor: '#aaaaaa',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Hapus',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed){
                        Livewire.emit('konfirmasiHapus')
                    }
                })
            });
        </script>
        <script>
            window.addEventListener('show-konfirmasi-hapusSemua', event => {
                Swal.fire({
                    title: 'Anda yakin menghapus semua data ?',
                    text: 'Semua akun yang tertaut akan terhapus !',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3086d6',
                    cancelButtonColor: '#aaaaaa',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Hapus',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed){
                        Livewire.emit('konfirmasiHapusSemua')
                    }
                })
            });
        </script>
    {{-- sweet alert --}}
    @include('sweetalert::alert')
</body>
</html>