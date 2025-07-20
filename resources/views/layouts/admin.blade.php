<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') - {{ config('app.name') }}</title>

    {{-- Memuat Aset CSS dan JS dari Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="flex h-screen">
        
        {{-- Memasukkan file sidebar --}}
        @include('layouts.partials._admin-sidebar')

        {{-- Konten Utama --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <div class="container mx-auto">
                    
                    <header class="mb-6">
                        <h1 class="text-2xl font-semibold text-gray-800">
                            @yield('header')
                        </h1>
                    </header>

                    @yield('content')

                </div>
            </main>
        </div>
    </div>
</body>
</html>