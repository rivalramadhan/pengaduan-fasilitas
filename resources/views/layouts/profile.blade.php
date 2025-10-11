<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Layanan Pengaduan')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-image: url("{{ asset('img/bg.png') }}");
            background-repeat: no-repeat;
            background-size: 100% auto;
            padding-top: 70px; 
        }
    </style>
    @stack('styles')
</head>
<body>

    @include('components.navbar')

    <main>
        @yield('content')
    </main>

    @include('components.footer')

    @stack('scripts')

</body>
</html>