<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LaporDesa')</title>
    <style>
        /* Gaya dasar yang dibutuhkan oleh halaman tamu */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            /* background-image: url("{{ asset('img/bg2.png') }}"); */
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
    </style>
    @stack('styles')
</head>
<body>

    <main>
        @yield('content')
    </main>

    @stack('scripts')

</body>
</html>