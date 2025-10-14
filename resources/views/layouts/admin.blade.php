<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f8f9fa; }
        .main-content {
            margin-left: 240px; /* Memberi ruang selebar sidebar */
        }
        .top-bar {
            background-color: #fff;
            display: flex;
            justify-content: flex-end; /* Posisi item di kanan */
            align-items: center;
            height: 70px;
            padding: 0 30px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .top-bar .user-info { display: flex; align-items: center; gap: 15px; }
        .top-bar .user-profile-pic { width: 36px; height: 36px; border-radius: 50%; background-color: #e9ecef; display: flex; align-items: center; justify-content: center; font-weight: bold; }
        .top-bar .logout-btn { background: none; border: none; cursor: pointer; color: #6c757d; font-size: 0.9em; font-weight: 600; }
        .top-bar .logout-btn:hover { color: #dc3545; }
    </style>
    @stack('styles')
</head>
<body>
    
    @include('components.admin-sidebar')

    <div class="main-content">
        <header class="top-bar">
            <div class="user-info">
                <div class="user-profile-pic">{{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}</div>
                <span>{{ Auth::user()->nama }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">(Logout)</button>
                </form>
            </div>
        </header>

        <main>
            @yield('content')
        </main>
    </div>

    @stack('scripts')
    
</body>
</html>