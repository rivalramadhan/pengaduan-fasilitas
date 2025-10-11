<style>
    .navbar { top: 0; left: 0; position: fixed; width: 100%; z-index: 1000; background-color: #080053; color: white; padding: 15px 25px; display: flex; justify-content: space-between; align-items: center; box-sizing: border-box; }
    .navbar .left-section, .navbar .right-section, .navbar .nav-link { display: flex; align-items: center; gap: 15px; }
    .navbar a { color: white; text-decoration: none; font-size: 1em; font-weight: bold; display: flex; align-items: center; gap: 8px; }
    .nav-link:hover { opacity: 0.8; }
    .navbar .icon { width: 24px; height: 24px; }
    .navbar .login, .navbar .signup { background-color: white; color: #0A0A46; padding: 8px 16px; border-radius: 20px; }

    /* ========== STYLE BARU UNTUK DROPDOWN ========== */
    .dropdown {
        position: relative;
        display: inline-block;
    }
    .dropdown-toggle {
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        color: white;
        font-size: 1em;
        font-weight: bold;
        font-family: Arial, sans-serif;
    }
    .dropdown-toggle .icon {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: white;
        padding: 4px;
        box-sizing: border-box;
        color: #080053;
    }
    .dropdown-menu {
        display: none; /* Sembunyi secara default */
        position: absolute;
        right: 0;
        top: 120%; /* Posisi di bawah tombol pemicu */
        background-color: white;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        border-radius: 8px;
        overflow: hidden; /* Agar border-radius bekerja */
    }
    .dropdown-menu a, .dropdown-menu .dropdown-logout-btn {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 0.9em;
    }
    .dropdown-menu a:hover, .dropdown-menu .dropdown-logout-btn:hover {
        background-color: #f1f1f1;
    }
    .dropdown-menu.show {
        display: block; /* Tampilkan dropdown */
    }
    .dropdown-menu form { margin: 0; }
</style>

<div class="navbar">
    <div class="left-section">
        <a href="{{ url('/') }}" class="nav-link">
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h7.5" /></svg>
            <span>Home</span>
        </a>
        @auth
            <a href="{{ route('laporan.index') }}" class="nav-link">
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                <span>Laporan Saya</span>
            </a>
        @endauth
    </div>

    <div class="right-section">
        @guest
            <a href="{{ route('register') }}" class="signup">
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.5a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" /></svg>
                <span>Daftar</span>
            </a>
            <a href="{{ route('login') }}" class="login">
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" /></svg>
                <span>Masuk</span>
            </a>
        @endguest

        @auth
            <div class="dropdown">
                <button onclick="toggleDropdown()" class="dropdown-toggle">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    <span>{{ Auth::user()->nama }}</span>
                </button>
                <div id="myDropdown" class="dropdown-menu">
                    <a href="#">Profile</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-logout-btn">Logout</button>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</div>

<script>
    function toggleDropdown() {
        document.getElementById("myDropdown").classList.toggle("show");
    }
    window.onclick = function(event) {
        if (!event.target.matches('.dropdown-toggle, .dropdown-toggle *')) {
            var dropdowns = document.getElementsByClassName("dropdown-menu");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>