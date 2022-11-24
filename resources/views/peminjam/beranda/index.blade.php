@extends('layouts/app')
@section('beranda')
    {{-- Banner --}}
    <section class="hero bg-warning" id="hero">
        <div class="container banner position-relative">
            <div class="row">
                <div class="tagline col-lg-8 col-md-10 d-lg-flex flex-lg-column justify-content-lg-end content-left" data-aos="fade-up">
                    <h1 class="mt-4 hero-title mb-3">Membuat Kegiatan Perpustakaan Menjadi Mudah dan Menyenangkan</h1>
                    <p class="hero-subheading text-white">Menyediakan layanan berbagai kebutuhan yang berhubungan dengan perpustakaan</p>
                    <a href="/#layanan" class="hero-button">
                        <button type="button" class="btn py-2 px-3 px-lg-4 py-lg-3 mt-4">
                            Cek Layanan
                        </button>
                    </a>
                </div>
            </div>
            <div class="d-none d-lg-block">
                <img src="/img/Tumpukan Buku.png" class="tumpukan-buku position-absolute img-fluid" alt="">
            </div>
        </div>
    </section>
    <!-- Layanan -->
    <section class="layanan" id="layanan">
        <div class="container">
            <div class="container-fluid pt-5 pb-5">
                <div class="container text-center">
                    <h2 class="display-3 heading">Layanan</h2>
                    <p class="subheading">Perpustakaan Digital SMPN 34 menyediakan layanan</p>
                        <hr>
                    <div class="row pt-4 d-flex wrap-layanan justify-content-center">
                        <a class="col-md-4 col-lg-3 card-layanan" href="/buku" data-aos="flip-left">
                            <div class="lingkaran">
                                <i class="fa-solid fa-book fa-5x"></i>
                            </div>
                            <h3 class="mt-3 heading">Peminjaman Buku</h3>
                            <p class="subheading">Layanan peminjaman buku digunakan dalam melakukan peminjaman buku oleh siswa dengan melakukan pinjam buku melalui website ini, yang selanjutnya diteruskan ke petugas perpustakaan untuk mengambil buku secara langsung</p>
                        </a>
                        <a class="col-md-4 col-lg-3 card-layanan" href="/ebook" data-aos="flip-left" data-aos-delay="300">
                            <div class="lingkaran">
                                <i class="fa-solid fa-book-atlas fa-5x"></i>
                            </div>
                            <h3 class="mt-3 heading">E-Book</h3>
                            <p class="subheading">Layanan fitur e-book atau buku digital digunakan oleh siswa untuk melakukan peminjaman buku digital dengan cara mengunduhnya atau membacanya secara langsung melalui website ini</p>
                        </a>
                        <a class="col-md-4 col-lg-3 card-layanan" href="/posts" data-aos="flip-left" data-aos-delay="600">
                            <div class="lingkaran">
                                <i class="fa-brands fa-blogger fa-5x"></i>
                            </div>
                            <h3 class="mt-3 heading">Blog</h3>
                            <p class="subheading">Layanan Blog digunakan oleh siswa untuk mengembangkan guna untuk mengembangkan kemampuan menulis siswa, berbagi pengetahuan yang bermanfaat dan dapat membangun tingkat kepercayaan siswa</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog -->
    @isset($rekomendasi)
        @if ($rekomendasi->isNotEmpty())
            <section class="blog section-margin" id="blog">
                <div class="container">
                    <div class="row text-center">
                        <div class="col">
                            <h1 class="heading">Rekomendasi Blog</h1>
                            <p class="subheading">Kami menyediakan beragam informasi yang menarik mengenai pengetahuan dan pengalaman siswa-siswi SMP Negeri 34 Jakarta</p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <!-- Swiper -->
                            <div class="swiper mySwiperBlog py-5">
                                <div class="swiper-wrapper">
                                    @foreach ($rekomendasi as $row)
                                        <div class="swiper-slide card" style="width: 18rem;">
                                            <a href="/posts/{{ $row->post->slug }}"><img src="/storage/{{ $row->post->sampul }}" class="card-img-top" alt="..."></a>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $row->post->judul }}</h5>
                                                <p class="date">{{ Carbon\Carbon::parse($row->updated_at)->format('d M Y')}}</p>
                                                <p class="card-text">{{ $row->post->kutipan }}</p>
                                                <a href="/posts/{{ $row->post->slug }}" class="btn text-white">Baca selengkapnya</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endisset
    <!-- Tentang -->
    <section class="tentang bg-light" id="tentang">
        <div class="container-fluid py-5">
            <div class="container">
                <h2 class="display-3 text-center heading">Tentang</h2>
                <p class="text-center subheading">
                    Profil dari SMP Negeri 34 Jakarta
                </p>
                    <hr>
                <div class="clearfix pt-5">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="heading">SMP Negeri 34 Jakarta</h4>                        
                            <hr>
                            <p class="subheading">Sekolah Menengah Pertama Negeri 34 Jakarta atau SMP Negeri 34 Jakarta atau oleh para remaja lebih dikenal dengan nama "OP34C" (dalam pengucapan: opék) adalah salah satu sekolah menengah pertama Negeri di Jakarta.</p>
                            <hr>
                            <h6 class="my-3 subheading">Alamat : Jl. Pademangan Timur VII, Jakarta Utara</h6> 
                            <h6 class="mb-3 subheading">Email : smp_34_jakarta@yahoo.co.id</h6> 
                            <h6 class="mb-3 subheading">Kode Pos : 14410</h6>
                            <hr>
                            <div class="row justify-content-start">
                                <a href="https://www.instagram.com/jakartasmpn34/?hl=id" class="social mx-2" target="_blank">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                                <a href="https://www.facebook.com/SMP-Negeri-34-Jakarta-159271510814407/" class="social mx-2" target="_blank">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/smpn34jkt" class="social mx-2" target="_blank">
                                    <i class="fa-brands fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 map">
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.996961881821!2d106.84318871455432!3d-6.131109095560716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a1e2109c3e253%3A0x160cfd5dcf4dacee!2sSMP%20Negeri%2034%20Jakarta%20Utara!5e0!3m2!1sid!2sid!4v1661099653559!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQ -->
    <section class="faq" id="faq">
        <div class="container-fluid py-5">
            <div class="container">
                <h2 class="display-3 text-center heading">FAQ</h2>
                <p class="text-center subheading">
                    Pertanyaan yang sering diajukan
                </p>
                    <hr>
                <div class="clearfix pt-5">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- Accordion --}}
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <ol class="mb-0">
                                                <li><strong>Bagaimana saya bisa memiliki akun perpustakaan digital SMP Negeri 34 Jakarta?</strong></li>
                                            </ol>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p class="subheading">Caranya adalah dengan mendaftarkan diri melalui petugas perpus atau registrasi dengan mengisi formulir pada tombol login</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <ol start="2" class="mb-0">
                                                <li><strong>Bagaimana cara melakukan peminjaman buku di perpustakaan digital SMP Negeri 34 Jakarta?</strong></li>
                                            </ol>
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p class="subheading">Syarat agar kamu dapat melakukan peminjaman buku adalah kamu harus memiliki akun terlebih dahulu untuk melakukan login.</p> <p>Jika sudah login kamu bisa melakukan peminjaman buku dengan memilih buku yang tersedia untuk dimasukkan keranjang dengan batasan buku maksimal sebanyak 2 buku berbeda.</p> <p>Setelah itu, kamu harus pergi ke perpustakaan untuk melakukan peminjaman buku dengan menyerahkan kode pinjam yang diterima. Batas peminjaman buku adalah 10 hari dari tanggal pinjam</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <ol start="3" class="mb-0">
                                                <li><strong>Bagaimana jika peminjaman buku melebihi waktu yang ditentukan?</strong></li>
                                            </ol>
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p class="subheading">Apabila siswa yang meminjam buku melewati batas waktu yang ditentukan, maka akan dikenakan denda sebesar Rp. 1.000,- per harinya </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            <ol start="4" class="mb-0">
                                                <li><strong>Apa itu E-Book?</strong></li>
                                            </ol>
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p class="subheading">E-Book merupakan buku berbentuk digital yang berisi informasi bermanfaat seperti layaknya buku pada umumnya </p>
                                            <p class="subheading">E-Book atau <i>electronic book</i> ini hanya dapat dibuka dan dibaca dengan menggunakan perangkat gadget, seperti komputer, laptop, tablet, dan handphone </p>
                                            <p class="subheading">
                                                E-Book memuat tulisan dan gambar yang dimiliki buku pada umumnya mengenai berbagai topik pembahasan
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFive">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                            <ol start="4" class="mb-0">
                                                <li><strong>Apa itu Blog?</strong></li>
                                            </ol>
                                        </button>
                                    </h2>
                                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p class="subheading">Blog merupakan fitur yang biasa digunakan oleh penulis dalam membuat konten berbentuk tulisan dan foto yang dikelola oleh penulis tersebut dan biasanya dikenal dengan nama blogger </p>
                                            <p class="subheading">Blog juga biasanya berisi konten yang memuat opini, pengalaman maupun informasi pengetahuan </p>
                                            <p class="subheading">
                                                Blog bisa bermanfaat untuk siswa dalam menyalurkan hobi menulis dan sekaligus untuk menuangkan kreatifitas menulis secara bebas.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="/img/faq.jpg" alt="FAQ.jpg" class="mb-3" width="100%" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Tim Kami -->
    {{-- <section class="tim-kami bg-light" id="tim-kami">
        <div class="container-fluid pt-5" id="tim-kami">
            <div class="container text-center">
                <h2 class="display-3 heading">Tim Kami</h2>
                    <hr>
                </div>
                <div class="row pt-4 gx-4 gy-4">
                    <div class="col-md-12 text-center tim">
                        <img src="/img/our-team.png" class="rounded-circle mb-3">
                        <h4 class="heading">Ryan Dhika Permana</h4>
                        <p class="subheading">Mahasiswa</p>
                        <p>
                            <a href="" class="social">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            <a href="" class="social">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                            <a href="" class="social">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection