<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>
    <body class="font-poppins antialiased bg-background">
        <div class="min-h-screen flex flex-col">
            <!-- Simple Navbar for standard pages like Profile -->
            <nav class="bg-primary text-white shadow-lg z-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16 items-center">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                            <span class="text-xl font-bold tracking-wider">SIPAWON</span>
                        </div>
                        <div>
                            <a href="{{ route('user.riwayat') }}" class="px-4 py-2 bg-white/10 hover:bg-white/20 rounded-lg transition font-semibold text-sm">
                                <i class="fa-solid fa-clock-rotate-left mr-2"></i>Riwayat Saya
                            </a>
                            <a href="{{ route('home') }}" class="px-4 py-2 bg-white/10 hover:bg-white/20 rounded-lg transition font-semibold text-sm">
                                <i class="fa-solid fa-house mr-2"></i>Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow-sm border-b border-gray-100 z-10 relative">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex items-center">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
