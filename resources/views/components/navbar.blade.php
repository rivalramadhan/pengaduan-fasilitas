<style>
    .navbar {
        top: 0;
        position: sticky;
        z-index: 1000;
        background-color: #080053;
        color: white;
        padding: 15px 25px; /* Sedikit padding tambahan */
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .navbar .left-section,
    .navbar .right-section,
    .navbar .nav-link,
    .navbar .profile {
        display: flex;
        align-items: center;
        gap: 15px; /* Jarak antar item */
    }
    .navbar a {
        color: white;
        text-decoration: none;
        font-size: 1em; /* Ukuran font standar */
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 8px; /* Jarak antara ikon dan teks */
    }
    .nav-link:hover {
        opacity: 0.8;
    }
    .navbar .icon {
        width: 24px;
        height: 24px;
    }
    .navbar .login, .navbar .signup {
        background-color: white;
        color: #0A0A46;
        padding: 8px 16px;
        border-radius: 20px;
    }
    .navbar .profile img, .navbar .profile .icon {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: white;
        padding: 4px; /* Padding agar ikon tidak terlalu mepet */
        box-sizing: border-box; /* Agar padding tidak menambah ukuran */
        color: #080053; /* Warna ikon di dalam lingkaran */
    }
</style>

<div class="navbar">
    <div class="left-section">
        <a href="{{ route('home') }}" class="nav-link">
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h7.5" />
            </svg>
        </a>
        
        @auth
            <a href="{{ route('laporan.index') }}" class="nav-link">
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                <span>Laporan</span>
            </a>
        @endauth
    </div>

    <div class="right-section">
        @guest
            <a href="{{ route('register') }}" class="signup">
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.5a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />
                </svg>
                <span>Daftar</span>
            </a>
            <a href="{{ route('login') }}" class="login">
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                </svg>
                <span>Masuk</span>
            </a>
        @endguest

        @auth
            <a href="{{ route('history') }}" class="nav-link">
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </a>
            <a href="{{ route('profile.show') }}" class="profile">
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <div class="username">{{ Auth::user()->name }}</div>
            </a>
        @endauth
    </div>
</div>