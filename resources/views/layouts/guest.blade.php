<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Autentikasi - SIPAWON</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>
    <body class="font-poppins antialiased text-gray-800 relative min-h-screen flex items-center justify-center overflow-x-hidden">
        
        <!-- Full Page Background -->
        <div class="fixed inset-0 z-0">
            <img src="{{ asset('images/background.png') }}" alt="Background" class="w-full h-full object-cover object-center">
            <div class="absolute inset-0 bg-gradient-to-br from-primary/95 to-secondary/90 mix-blend-multiply"></div>
            <!-- Decorative blur blobs -->
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-accent/30 blur-[100px]"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-96 h-96 rounded-full bg-blue-500/30 blur-[100px]"></div>
        </div>

        <div class="relative z-10 w-full max-w-md px-6 py-12">
            <!-- Header/Logo -->
            <div class="flex flex-col items-center mb-8 animate-fade-in text-center">
                <a href="{{ route('home') }}" class="group block">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-24 h-24 mb-4 object-contain drop-shadow-2xl group-hover:scale-110 transition-transform mx-auto">
                    <h1 class="text-4xl font-bold text-white tracking-widest drop-shadow-md">SIPAWON</h1>
                </a>
                <p class="text-gray-200 font-inter mt-2 drop-shadow-md text-sm">Sistem Pelayanan Publik Digital<br>Polres Wonogiri</p>
            </div>

            <!-- Card Form -->
            <div class="bg-white/95 backdrop-blur-xl p-8 sm:p-10 rounded-[2rem] shadow-2xl border border-white/40 animate-slide-up relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-secondary via-primary to-accent"></div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
