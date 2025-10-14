<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            background-color: #f8f9fa; /* Background abu-abu muda */
        }
    </style>
    @stack('styles')
</head>
<body>
    
    @include('components.admin-navbar')

    <main>
        @yield('content')
    </main>

    @stack('scripts')
    
</body>
</html>