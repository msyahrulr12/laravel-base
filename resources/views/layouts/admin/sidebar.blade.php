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
        </ul>
    </div>
</nav>
