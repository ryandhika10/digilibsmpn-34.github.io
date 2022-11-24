  <nav class="main-header navbar dashboard-nav navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars sidebar" style="height: 30px;"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          @if (isset(auth()->user()->foto))
            <img src="/storage/{{ auth()->user()->foto }}" class="img-circle elevation-2" alt="Foto User">
          @else
            <img src="/storage/foto-user/user.png" class="img-circle elevation-2" alt="Foto User">
          @endif
          {{auth()->user()->nama}}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="/profile" class="dropdown-item {{ Request:: is('profile') ? 'active' : '' }}">
            <i class="fa-solid fa-id-card mr-2"></i> Profil
          </a>
          <div class="dropdown-divider"></div>
          <a href="/" class="dropdown-item">
            <i class="fa-solid fa-house mr-2"></i> Beranda
          </a>
          <div class="dropdown-divider"></div>
          <form action="/logout" method="post" class="keluar-dashboard dropdown-item">
            @csrf
            <button type="submit"><i class="fa-solid fa-right-from-bracket mr-2"></i> Keluar</button>
          </form>
        </div>
      </li>
    </ul>
  </nav>