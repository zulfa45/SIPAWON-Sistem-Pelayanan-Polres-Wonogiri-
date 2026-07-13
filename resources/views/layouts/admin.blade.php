<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Admin Panel - SIPAWON</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
    </head>
    <body class="font-poppins antialiased text-gray-800 bg-background">
        <div class="min-h-screen flex" x-data="{ sidebarOpen: false }">
            
            <!-- Mobile Sidebar Backdrop -->
            <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/80 z-20 md:hidden" style="display: none;"></div>

            <!-- Sidebar -->
            <aside class="w-64 bg-primary text-white flex-shrink-0 fixed h-full z-30 shadow-2xl transform transition-transform duration-300 md:translate-x-0" :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }">
                <div class="h-16 flex items-center justify-center border-b border-white/10 bg-primary">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8 mr-3 object-contain filter brightness-0 invert">
                    <span class="text-xl font-bold tracking-wider">SIPAWON</span>
                </div>
                <div class="p-4 mt-2 h-[calc(100vh-4rem)] overflow-y-auto">
                    <p class="text-xs text-white/50 font-inter uppercase tracking-wider mb-4">Main Menu</p>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-accent font-bold' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                                <i class="fa-solid fa-gauge w-5"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.berita.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.berita.*') ? 'bg-white/10 text-accent font-bold' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                                <i class="fa-solid fa-newspaper w-5"></i> Kelola Berita
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.sim.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.sim.*') ? 'bg-white/10 text-accent font-bold' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                                <i class="fa-solid fa-id-card w-5"></i> Registrasi SIM
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.stnk.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.stnk.*') ? 'bg-white/10 text-accent font-bold' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                                <i class="fa-solid fa-car w-5"></i> Registrasi STNK
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.skck.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.skck.*') ? 'bg-white/10 text-green-400 font-bold' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                                <i class="fa-solid fa-fingerprint w-5"></i> SKCK Online
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.pengaduan.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.pengaduan.*') ? 'bg-white/10 text-danger font-bold' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                                <i class="fa-solid fa-file-shield w-5"></i> Pengaduan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.users.*') ? 'bg-white/10 text-accent font-bold' : 'hover:bg-white/5 text-gray-300 hover:text-white' }}">
                                <i class="fa-solid fa-users w-5"></i> Kelola Pengguna
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 md:ml-64 flex flex-col min-h-screen w-full">
                
                <!-- Top Navbar -->
                <header class="h-16 bg-white shadow-sm flex items-center justify-between px-4 md:px-8 sticky top-0 z-10 border-b border-gray-100">
                    <div class="flex items-center gap-4">
                        <!-- Mobile Hamburger -->
                        <button @click="sidebarOpen = true" class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none">
                            <i class="fa-solid fa-bars text-xl"></i>
                        </button>

                        <!-- Page Title / Header Slot -->
                        @if (isset($header))
                            {{ $header }}
                        @else
                            <h2 class="font-bold text-gray-700 text-lg">Admin Panel</h2>
                        @endif
                    </div>
                    
                    <div class="flex items-center gap-6">
                        <!-- Profile Dropdown (using Alpine.js included in app.js) -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center gap-3 focus:outline-none bg-gray-50 hover:bg-gray-100 py-1.5 px-3 rounded-full transition">
                                @if(Auth::user()->avatar)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="w-8 h-8 rounded-full object-cover shadow-sm">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-secondary text-white flex items-center justify-center font-bold text-sm shadow-sm">
                                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                                    </div>
                                @endif
                                <span class="font-inter text-sm font-semibold text-gray-700 hidden sm:block">{{ Auth::user()->name ?? 'Administrator' }}</span>
                                <i class="fa-solid fa-chevron-down text-xs text-gray-400"></i>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false" x-transition.opacity class="absolute right-0 mt-3 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2" style="display: none;">
                                <div class="px-4 py-2 border-b border-gray-50 mb-2">
                                    <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name ?? 'Admin' }}</p>
                                    <p class="text-xs text-gray-500 font-inter">{{ Auth::user()->email ?? 'admin@admin.com' }}</p>
                                </div>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition">
                                    <i class="fa-regular fa-user mr-2"></i> Profil
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-danger hover:bg-red-50 transition mt-1">
                                        <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 p-4 md:p-8 overflow-x-hidden">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
