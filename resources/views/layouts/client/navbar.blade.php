<header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="{{ route('home') }}" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>Laskar Merah Putih Indonesia Brigade III <br> Korwil V Jawa Barat</h1>
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{ route('home') }}">Beranda</a></li>
          <li><a href="{{ route('home') }}#about">Tentang</a></li>
          <li><a href="{{ route('home') }}#visi_misi">Visi & Misi</a></li>
          <li><a href="{{ route('documentations.index') }}">Dokumentasi</a></li>
          <li><a href="{{ route('blogs') }}">Blog</a></li>
          <li><a href="{{ route('portofolios.index') }}">Program Kerja</a></li>
          {{-- <li><a href="#portfolio">Portfolio</a></li> --}}
          <li class="dropdown"><a href="#"><span>Keanggotaan</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
                <li><a href="{{ route('members.board-of-management') }}">Susunan Pengurus</a></li>
                <li><a href="{{ route('members.regulation') }}">Persyaratan</a></li>
                <li><a href="{{ route('members.download-form') }}">Formulir Pendaftaran</a></li>
            </ul>
          </li>
          {{-- <li class="dropdown"><a href="#"><span>Lainnya</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
                <li class="dropdown"><a href="#"><span>Keanggotaan</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <li><a href="{{ route('members.regulation') }}">Susunan Pengurus</a></li>
                <li><a href="{{ route('members.regulation') }}">Persyaratan</a></li>
                <li><a href="{{ route('members.download-form') }}">Formulir Pendaftaran</a></li>
                <ul>
                    <li><a href="#">Deep Drop Down 3</a></li>
                    <li><a href="#">Deep Drop Down 4</a></li>
                    <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
                </li>
                <li><a href="#">Download Formulir Pendaftaran</a></li>
                <li><a href="#">Drop Down 3</a></li>
                <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li> --}}
          {{-- <li><a href="#contact">Contact</a></li> --}}
        </ul>
      </nav><!-- .navbar -->

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->
  <!-- End Header -->
