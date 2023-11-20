<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">

        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Nama Perusahaan</span>
        </a>

        <ul class="sidebar-nav">
            @foreach ($my_menu as $key => $menuHeader)
                <li class="sidebar-header">
                    {{ $menuHeader['name'] }}
                </li>

                @foreach ($menuHeader['menus'] as $key1 => $menu)
                    <li class="sidebar-item {{ $title && $title == $menu['name'] ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ $menu['link'] }}">
                            <i class="align-middle" data-feather="{{ $menu['icon'] }}"></i> <span class="align-middle">{{ $menu['name'] }}</span>
                        </a>
                    </li>
                @endforeach
            @endforeach

            {{-- <li class="sidebar-header">
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
            </li> --}}
        </ul>
    </div>
</nav>
