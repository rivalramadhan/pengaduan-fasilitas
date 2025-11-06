<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 240px;
        background-color: #1a202c; /* Dark background */
        color: #a0aec0; /* Light grey text */
        padding: 20px;
        box-sizing: border-box;
    }
    .sidebar .brand {
        font-size: 1.8em;
        font-weight: 700;
        color: #fff;
        text-align: center;
        margin-bottom: 30px;
        display: block;
        text-decoration: none;
    }
    .sidebar .nav-group-title {
        font-size: 0.8em;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 25px;
        margin-bottom: 10px;
        font-weight: 700;
    }
    .sidebar .nav-link {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 12px 15px;
        border-radius: 8px;
        text-decoration: none;
        color: #a0aec0;
        font-weight: 500;
        transition: background-color 0.3s, color 0.3s;
    }
    .sidebar .nav-link .icon {
        width: 20px;
        height: 20px;
    }
    .sidebar .nav-link:hover {
        background-color: #2d3748;
        color: #fff;
    }
    /* Style untuk link yang sedang aktif */
    .sidebar .nav-link.active {
        background-color: #3A64A3; /* Primary blue color */
        color: #fff;
    }
</style>

<aside class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="brand">Admin Panel</a>

    <div class="nav-group-title">Menu Utama</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <svg class="icon" ...></svg>
        <span>Dashboard</span>
    </a>
    
    <a href="{{ route('admin.laporan.index') }}" class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
        <svg class="icon" ...></svg> <span>Kelola Laporan</span>
    </a>

    <div class="nav-group-title">Master Data</div>
    <a href="{{ route('admin.manage-users.index') }}" class="nav-link {{ request()->routeIs('admin.manage-users.*') ? 'active' : '' }}">
        <svg class="icon" ...></svg>
        <span>Kelola User</span>
    </a>
    <a href="{{ route('admin.manage-fasilitas.index') }}" class="nav-link {{ request()->routeIs('admin.manage-fasilitas.*') ? 'active' : '' }}">
        <svg class="icon" ...></svg>
        <span>Kelola Fasilitas</span>
    </a>
</aside>