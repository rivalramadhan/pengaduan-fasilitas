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
        <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" /></svg>
        <span>Dashboard</span>
    </a>

    <div class="nav-group-title">Master Data</div>
    <a href="{{ route('admin.manage-users.index') }}" class="nav-link {{ request()->routeIs('admin.manage-users.*') ? 'active' : '' }}">
        <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-4.67c.12-.143.25-.286.38-.431 1.003-1.03 1.398-2.397 1.398-3.771v-.217A6.375 6.375 0 0111.25 4.5 6.375 6.375 0 0117.625 10.875c0 1.373-.396 2.741-1.398 3.771a6.375 6.375 0 01-1.398 3.771z" /></svg>
        <span>Kelola User</span>
    </a>
    <a href="{{ route('admin.manage-fasilitas.index') }}" class="nav-link {{ request()->routeIs('admin.manage-fasilitas.*') ? 'active' : '' }}">
        <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125A2.25 2.25 0 014.5 4.875h15A2.25 2.25 0 0121.75 7.125v1.597a2.25 2.25 0 01-.745 1.707l-6 6.001a2.25 2.25 0 01-3.182 0l-6-6.001A2.25 2.25 0 012.25 8.722V7.125z M10.5 13.818a.75.75 0 001.06 0l6-6.001a.75.75 0 00-1.06-1.06L12 11.188 7.56 6.75a.75.75 0 10-1.06 1.06l4 3.999z" /></svg>
        <span>Kelola Fasilitas</span>
    </a>
    </aside>