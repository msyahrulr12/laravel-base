<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Laskar Merah Putih</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Role & Permission
            </li>

            <li class="sidebar-item {{ $title && $title == 'Role' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.roles.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Role</span>
                </a>
            </li>
            <li class="sidebar-item {{ $title && $title == 'Permission' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.permissions.index') }}">
                    <i class="align-middle" data-feather="user-check"></i> <span class="align-middle">Permission</span>
                </a>
            </li>

            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item {{ $title && $title == 'Dashboard' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ $title && $title == 'About Us' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.about_us.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">About Us</span>
                </a>
            </li>

            <li class="sidebar-item {{ $title && $title == 'Social Media' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.social_media.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Social Media</span>
                </a>
            </li>

            <li class="sidebar-item {{ $title && $title == 'Contact Us' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.contact_us.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Contact Us</span>
                </a>
            </li>

            <li class="sidebar-item {{ $title && $title == 'Member' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.users.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Member</span>
                </a>
            </li>

            <li class="sidebar-item {{ $title && $title == 'Region' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.regions.index') }}">
                    <i class="align-middle" data-feather="map"></i> <span class="align-middle">Wilayah</span>
                </a>
            </li>

            <li class="sidebar-item {{ $title && $title == 'Peraturan' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.regulations.index') }}">
                    <i class="align-middle" data-feather="info"></i> <span class="align-middle">Peraturan</span>
                </a>
            </li>

            <li class="sidebar-item {{ $title && $title == 'Vision & Mission' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.vision_missions.index') }}">
                    <i class="align-middle" data-feather="target"></i> <span class="align-middle">Vision & Mission</span>
                </a>
            </li>

            <li class="sidebar-item {{ $title && $title == 'Formulir' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.forms.index') }}">
                    <i class="align-middle" data-feather="file"></i> <span class="align-middle">Formulir</span>
                </a>
            </li>

            <li class="sidebar-item {{ $title && $title == 'Dokumentasi' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.documentations.index') }}">
                    <i class="align-middle" data-feather="file"></i> <span class="align-middle">Dokumentasi</span>
                </a>
            </li>

            <li class="sidebar-item {{ $title && $title == 'Blog' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.blogs.index') }}">
                    <i class="align-middle" data-feather="layout"></i> <span class="align-middle">Blog</span>
                </a>
            </li>

            <li class="sidebar-item {{ $title && $title == 'Program Kerja' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.work_programs.index') }}">
                    <i class="align-middle" data-feather="award"></i> <span class="align-middle">Program Kerja</span>
                </a>
            </li>

            <li class="sidebar-item {{ $title && $title == 'Susunan Anggota' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.board_of_managements.index') }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Susunan Anggota</span>
                </a>
            </li>

            <li class="sidebar-item {{ $title && $title == 'Setting Kartu Anggota' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.card_members.index') }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Setting Kartu Anggota</span>
                </a>
            </li>

            {{-- <li class="sidebar-item">
                <a class="sidebar-link" href="pages-profile.html">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                </a>
            </li> --}}

            {{-- <li class="sidebar-item">
                <a class="sidebar-link" href="pages-sign-in.html">
                    <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Sign In</span>
                </a>
            </li> --}}

            {{-- <li class="sidebar-item">
                <a class="sidebar-link" href="pages-sign-up.html">
                    <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Sign Up</span>
                </a>
            </li> --}}

            {{-- <li class="sidebar-item">
                <a class="sidebar-link" href="pages-blank.html">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Blank</span>
                </a>
            </li> --}}
        </ul>
    </div>
</nav>
