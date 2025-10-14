<style>
    .admin-navbar {
        position: sticky; /* Menempel di atas saat scroll */
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        background-color: #ffffff; /* Background putih */
        color: #343a40; /* Teks gelap */
        padding: 0 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 70px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08); /* Shadow halus */
        box-sizing: border-box;
    }
    .admin-navbar .nav-left, .admin-navbar .nav-right {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .admin-navbar a, .admin-navbar span, .admin-navbar button {
        color: #343a40;
        text-decoration: none;
        font-family: Arial, sans-serif;
        font-size: 1em;
        font-weight: 600; /* Teks sedikit lebih tebal */
    }
    .admin-navbar .brand {
        font-size: 1.5em;
        font-weight: 700;
    }
    .admin-navbar .user-profile-pic {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
    .logout-btn {
        background: none;
        border: none;
        cursor: pointer;
        color: #6c757d; /* Warna lebih soft untuk logout */
        font-size: 0.9em;
    }
    .logout-btn:hover {
        color: #dc3545; /* Merah saat hover */
    }
</style>
<nav class="admin-navbar">
    <div class="nav-left">
        <a href="{{ route('admin.dashboard') }}" class="brand">Admin Panel</a>
    </div>
    <div class="nav-right">
        <div class="user-profile-pic">
            {{-- Mengambil inisial nama --}}
            {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
        </div>
        <span>{{ Auth::user()->nama }}</span>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">(Logout)</button>
        </form>
    </div>
</nav>