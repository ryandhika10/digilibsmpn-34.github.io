        <header>
            <nav class="navbar navbar-expand-lg fixed-top shadow-lg py-2">
                <div class="container">
                    <a class="navbar-brand" href="/">                        
                        <img src="/img/icon.png" alt="" width="40" class="d-inline-block align-text-center">
                        <span class="d-inline-block text-wrap">Perpustakaan Digital SMPN 34 Jakarta</span>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="menu collapse navbar-collapse" id="navbarSupportedContent">
                        @if (Request:: is('/'))
                            <ul class="navbar-nav me-sm-auto mb-2 mb-lg-0" id="navbar-spy">
                                <li class="nav-item ms-sm-3">
                                    <a class="nav-link" href="/#hero" >
                                        Beranda
                                    </a>
                                </li>
                                <li class="nav-item dropdown ms-sm-3">
                                    <a class="nav-link smooth-scroll dropdown-toggle {{ Request:: is('/#layanan') ? 'active' : '' }}" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="/#layanan">
                                        Layanan
                                    </a>
                                    <ul class="dropdown-menu nav-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li>
                                            <a class="dropdown-item {{ Request:: is('buku') ? 'active' : '' }}" href="/buku">Buku</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item {{ Request:: is('ebook') ? 'active' : '' }}" href="/ebook">E-Book</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item {{ Request:: is('posts') ? 'active' : '' }}" href="/posts">Blog</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item ms-sm-3">
                                    <a class="nav-link" href="/#tentang" >
                                        Tentang
                                    </a>
                                </li>
                                <li class="nav-item ms-sm-3">
                                    <a class="nav-link" href="/#faq" >
                                        FAQ
                                    </a>
                                </li>
                                {{-- <li class="nav-item ms-sm-3">
                                    <a class="nav-link" href="/#tim-kami" >
                                        Tim Kami
                                    </a>
                                </li> --}}
                            </ul>
                        @else
                            <ul class="navbar-nav me-sm-auto mb-2 mb-lg-0" id="navbar-spy">
                                <li class="nav-item ms-sm-3">
                                    <a class="nav-link" href="/#hero" >
                                        Beranda
                                    </a>
                                </li>
                                <li class="nav-item ms-sm-3">
                                    <a class="nav-link {{ (Request:: is('buku') || Request:: is('buku/*')) ? 'active' : ''}}" href="/buku">
                                        Buku
                                    </a>
                                </li>
                                <li class="nav-item ms-sm-3">
                                    <a class="nav-link {{ (Request:: is('ebook') || Request:: is('ebook/*')) ? 'active' : ''}}" href="/ebook" >
                                        E-Book
                                    </a>
                                </li>
                                <li class="nav-item ms-sm-3">
                                    <a class="nav-link {{ (Request:: is('posts') || Request:: is('posts/*')) ? 'active' : '' }}" href="/posts" >
                                        Blog
                                    </a>
                                </li>
                            </ul>
                        @endif
                        
                        <ul class="navbar-nav d-flex login-register">
                            @auth
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ auth()->user()->nama }}
                                    </a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i> Dashboard</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="/logout" method="post" class="mb-0">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item"><i class="fa-solid fa-right-from-bracket"></i>Keluar</button>
                                                </form>
                                            </li>
                                        </ul>
                                </li>
                            @else
                                <li class="nav-item register">
                                    <a href="/register_sebagai" class="nav-link {{ Request:: is('register_sebagai') || Request:: is('siswa_register') || Request:: is('guru_register') ? 'active' : '' }}"><i class="fa-solid fa-file-pen"></i> Daftar</a>
                                </li>
                                <li class="nav-item login">
                                    <a href="/login" class="nav-link {{ Request:: is('login') || Request:: is('password/reset') ? 'active' : '' }}"><i class="fa-solid fa-right-to-bracket"></i> Masuk</a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>
        </header>