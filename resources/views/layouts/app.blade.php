<!doctype html>
<html lang="en">
    <head>
        @include('layouts/header')
        @livewireStyles
    </head>
    <body data-bs-spy="scroll" data-bs-target="#navbar-spy" data-bs-offset="150" class="scrollspy-example" tabindex="0">    
            @include('layouts/navbar')
                @yield('beranda')
                @yield('content')
            @include('layouts/footer')
            @include('layouts/arrowtop')
            @include('layouts/javascript')
            @yield('script')
        @livewireScripts 
            {{-- Swiper --}}
            <script>
                var swiper = new Swiper(".mySwiperBlog", {
                    grabCursor: true,
                    spaceBetween: 20,
                    centeredSlides: false,
                    slidesPerView: "auto",
                    pagination: {
                        el: ".swiper-pagination",
                    },
                    autoplay: {
                        delay: 2500,
                        disableOnInteraction: false,
                    },
                });
        </script>
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