    <aside class="main-sidebar masuk-brand sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/dashboard" class="brand-link">
            <img src="/img/icon.png" alt="SMPN 34 Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Perpustakaan 34</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    @if (isset(auth()->user()->foto))
                        <img src="/storage/{{ auth()->user()->foto }}" class="img-circle elevation-2" alt="Foto User">
                    @else
                        <img src="/storage/foto-user/user.png" class="img-circle elevation-2" alt="Foto User">
                    @endif
                </div>
                <div class="info">
                    <a href="/profile" class="d-block nama-user  @yield('active-profile')">{{auth()->user()->nama}}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="dashboard-kebawah nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link @yield('active-dashboard')">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">UMUM</li>
                        <li class="nav-item">
                            <a href="/kategori" class="nav-link @yield('active-kategori')">
                                <i class="fa-solid fa-border-all"></i>
                                <p>
                                    Kategori
                                </p>
                            </a>
                        </li>
                    @role('petugas|admin')
                        <li class="nav-item">
                            <a href="/penerbit" class="nav-link @yield('active-penerbit')">
                                <i class="fa-solid fa-newspaper"></i>
                                <p>
                                    Penerbit
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/tempat-terbit" class="nav-link @yield('active-tempat-terbit')">
                                <i class="fa-solid fa-location-dot"></i>
                                <p>
                                    Tempat Terbit
                                </p>
                            </a>
                        </li>
                    @endrole
                    @role('siswa|guru|alumni')
                        <li class="nav-item">
                            <a href="/tag" class="nav-link @yield('active-d-tag')">
                                <i class="fa-solid fa-tags"></i>
                                <p>
                                    Tag
                                </p>
                            </a>
                        </li>
                    @endrole
                        <li class="nav-header">DATA</li>
                    @role('petugas|admin')
                        <li class="nav-item @yield('collapse-data-buku')">
                            <a href="#" class="nav-link @yield('active-data-buku')">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Data Buku
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/rak" class="nav-link @yield('active-rak')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Rak</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/d-buku" class="nav-link @yield('active-d-buku')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Buku</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item @yield('collapse-data-ebook')">
                            <a href="#" class="nav-link @yield('active-data-ebook')">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Data E-Book
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                <li class="nav-item">
                                    <a href="/d-ebook" class="nav-link @yield('active-d-ebook')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>E-Book</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endrole
                    @role('siswa|guru|alumni')
                        <li class="nav-item @yield('collapse-data-blog')">
                            <a href="#" class="nav-link @yield('active-data-blog')">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Data Blog
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/d-blog" class="nav-link @yield('active-d-post')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Post Saya</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endrole
                    @role('petugas|admin')
                        <li class="nav-header">TRANSAKSI</li>
                        <li class="nav-item">
                            <a href="/transaksi-buku" class="nav-link @yield('active-transaksi-buku')">
                                <i class="fa-solid fa-book"></i>
                                <p>
                                    Transaksi Buku
                                </p>
                            </a>
                        </li>

                        {{-- <li class="nav-item">
                            <a href="/chart" class="nav-link @yield('active-chart')">
                                <i class="fa-solid fa-chart-column"></i>
                                <p>
                                    Chart
                                </p>
                            </a>
                        </li> --}}
                    @endrole
                    @role('admin|petugas')
                        @if (auth()->user()->hasRole('admin'))
                            <li class="nav-header">ADMIN</li>
                        @elseif(auth()->user()->hasRole('petugas'))
                            <li class="nav-header">PETUGAS</li>
                        @endif
                        <li class="nav-item @yield('collapse-data-user')">
                            <a href="#" class="nav-link @yield('active-data-user')">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Data User
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                <li class="nav-item">
                                    <a href="/user" class="nav-link @yield('active-user')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Semua User</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                <li class="nav-item">
                                    <a href="/guru" class="nav-link @yield('active-guru')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Guru</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                <li class="nav-item">
                                    <a href="/siswa" class="nav-link @yield('active-siswa')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Siswa</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endrole
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>