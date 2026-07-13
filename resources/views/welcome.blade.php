<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPAWON - Sistem Pelayanan Polres Wonogiri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="font-poppins bg-background text-gray-800 antialiased selection:bg-primary selection:text-white">

    <!-- Navbar (Alpine.js for scroll effect) -->
    <nav x-data="{ scrolled: false, mobileMenuOpen: false }" @scroll.window="scrolled = (window.pageYOffset > 50)"
        :class="scrolled ? 'bg-primary/95 backdrop-blur-md shadow-lg py-3' : 'bg-transparent py-5'"
        class="fixed w-full z-50 transition-all duration-300 text-white">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 object-contain">
                <span class="text-2xl font-bold tracking-wider">SIPAWON</span>
            </div>
            
            <div class="hidden md:flex space-x-8 font-medium">
                <a href="#" class="hover:text-accent transition-colors">Beranda</a>
                <a href="#layanan" class="hover:text-accent transition-colors">Pelayanan</a>
                <a href="#alur" class="hover:text-accent transition-colors">Alur</a>
                <a href="#berita" class="hover:text-accent transition-colors">Berita</a>
                <a href="#faq" class="hover:text-accent transition-colors">FAQ</a>
            </div>

            <div class="hidden md:flex space-x-4 items-center">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="px-6 py-2 bg-white text-primary rounded-full font-semibold hover:bg-gray-100 transition shadow-lg">Admin Panel</a>
                    @endif
                    
                    <!-- Profile Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 focus:outline-none">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="w-10 h-10 rounded-full border-2 border-white shadow-lg object-cover">
                            @else
                                <div class="w-10 h-10 rounded-full bg-accent text-primary font-bold flex items-center justify-center border-2 border-white shadow-lg">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                        </button>
                        
                        <div x-show="open" style="display: none;" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl overflow-hidden z-50 text-gray-800">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-bold truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-primary/5 hover:text-primary transition"><i class="fa-solid fa-user mr-2"></i> Profil Saya</a>
                            <a href="{{ route('user.riwayat') }}" class="block px-4 py-2 text-sm hover:bg-primary/5 hover:text-primary transition"><i class="fa-solid fa-clock-rotate-left mr-2"></i> Riwayat Saya</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-danger hover:bg-red-50 transition"><i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-2 border border-white rounded-full font-semibold hover:bg-white hover:text-primary transition">Login</a>
                    <a href="{{ route('register') }}" class="px-6 py-2 bg-accent text-primary rounded-full font-semibold hover:bg-yellow-400 transition shadow-lg">Registrasi</a>
                @endauth
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="md:hidden flex items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white hover:text-accent focus:outline-none p-2">
                    <i class="fa-solid fa-bars text-2xl" :class="{'hidden': mobileMenuOpen, 'inline-block': !mobileMenuOpen }"></i>
                    <i class="fa-solid fa-xmark text-2xl" :class="{'hidden': !mobileMenuOpen, 'inline-block': mobileMenuOpen }" style="display: none;"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div x-show="mobileMenuOpen" x-transition.opacity @click.away="mobileMenuOpen = false" style="display: none;" class="md:hidden absolute top-full left-0 w-full bg-primary/95 backdrop-blur-md shadow-xl border-t border-white/10 pb-4">
            <div class="px-6 pt-4 pb-2 space-y-3 font-medium flex flex-col border-b border-white/10">
                <a @click="mobileMenuOpen = false" href="#" class="block hover:text-accent transition-colors">Beranda</a>
                <a @click="mobileMenuOpen = false" href="#layanan" class="block hover:text-accent transition-colors">Pelayanan</a>
                <a @click="mobileMenuOpen = false" href="#alur" class="block hover:text-accent transition-colors">Alur</a>
                <a @click="mobileMenuOpen = false" href="#berita" class="block hover:text-accent transition-colors">Berita</a>
                <a @click="mobileMenuOpen = false" href="#faq" class="block hover:text-accent transition-colors">FAQ</a>
            </div>
            <div class="px-6 py-4 flex flex-col gap-3">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="block text-center w-full px-4 py-3 bg-white text-primary rounded-xl font-bold">Admin Panel</a>
                    @endif
                    <div class="flex items-center gap-3 mb-2 px-2 py-3 bg-white/10 rounded-xl">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover">
                        @else
                            <div class="w-10 h-10 rounded-full bg-accent text-primary font-bold flex items-center justify-center">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <p class="font-bold text-sm">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-white/70">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="block w-full px-4 py-2 hover:bg-white/10 rounded-lg transition"><i class="fa-solid fa-user mr-2 w-5"></i> Profil Saya</a>
                    <a href="{{ route('user.riwayat') }}" class="block w-full px-4 py-2 hover:bg-white/10 rounded-lg transition"><i class="fa-solid fa-clock-rotate-left mr-2 w-5"></i> Riwayat Saya</a>
                    <form method="POST" action="{{ route('logout') }}" class="w-full mt-2">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-3 bg-danger/90 hover:bg-danger text-white rounded-xl transition font-bold"><i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block text-center w-full px-4 py-3 border border-white rounded-xl font-bold hover:bg-white hover:text-primary transition">Login</a>
                    <a href="{{ route('register') }}" class="block text-center w-full px-4 py-3 bg-accent text-primary rounded-xl font-bold hover:bg-yellow-400 transition">Registrasi</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="relative min-h-screen flex items-center justify-center pt-20 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/background.png') }}" alt="Polres Wonogiri" class="w-full h-full object-cover object-center" />
            <div class="absolute inset-0 bg-gradient-to-r from-primary/90 to-secondary/80"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 flex flex-col md:flex-row items-center">
            <div class="w-full md:w-1/2 text-white animate-slide-up">
                <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6">Pelayanan Publik Digital <br> <span class="text-accent">Polres Wonogiri</span></h1>
                <p class="text-lg md:text-xl text-gray-200 mb-10 font-inter">Melayani masyarakat dengan pelayanan yang cepat, transparan, aman, dan terpercaya secara digital.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#layanan" class="px-8 py-3 bg-accent text-primary text-center rounded-full font-semibold text-lg hover:bg-yellow-400 transition shadow-lg hover:scale-105 transform">Daftar Pelayanan</a>
                    <a href="{{ route('register') }}" class="px-8 py-3 bg-white/20 backdrop-blur-sm border border-white/50 text-white text-center rounded-full font-semibold text-lg hover:bg-white hover:text-primary transition shadow-lg">Laporkan Pengaduan</a>
                </div>
            </div>
            <div class="w-full md:w-1/2 mt-12 md:mt-0 flex justify-center animate-float">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Polres Wonogiri" class="max-w-sm w-full drop-shadow-2xl opacity-95 object-contain">
            </div>
        </div>
        
        <!-- Wave Divider -->
        <div class="absolute bottom-0 w-full overflow-hidden leading-none z-10">
            <svg class="relative block w-[calc(100%+1.3px)] h-[50px] md:h-[100px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.08,130.83,119.5,193,105.7,238.13,95.73,283.47,76.54,321.39,56.44Z" class="fill-background"></path>
            </svg>
        </div>
    </header>

    <!-- Statistik Section -->
    <section class="py-16 -mt-10 relative z-20">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Card Pengaduan -->
                <div class="glass rounded-2xl p-6 text-center transform hover:-translate-y-2 transition duration-300">
                    <div class="w-16 h-16 mx-auto bg-primary/10 rounded-full flex items-center justify-center mb-4">
                        <i class="fa-solid fa-file-shield text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-primary mb-2">1,245</h3>
                    <p class="text-gray-600 font-inter text-sm">Total Pengaduan</p>
                </div>
                <!-- Card 2 -->
                <div class="glass rounded-2xl p-6 text-center transform hover:-translate-y-2 transition duration-300">
                    <div class="w-16 h-16 mx-auto bg-primary/10 rounded-full flex items-center justify-center mb-4">
                        <i class="fa-solid fa-id-card text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-primary mb-2">4,521</h3>
                    <p class="text-gray-600 font-inter text-sm">Pelayanan SIM</p>
                </div>
                <!-- Card 3 -->
                <div class="glass rounded-2xl p-6 text-center transform hover:-translate-y-2 transition duration-300">
                    <div class="w-16 h-16 mx-auto bg-primary/10 rounded-full flex items-center justify-center mb-4">
                        <i class="fa-solid fa-car text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-primary mb-2">3,890</h3>
                    <p class="text-gray-600 font-inter text-sm">Registrasi STNK</p>
                </div>
                <!-- Card 4 -->
                <div class="glass rounded-2xl p-6 text-center transform hover:-translate-y-2 transition duration-300">
                    <div class="w-16 h-16 mx-auto bg-primary/10 rounded-full flex items-center justify-center mb-4">
                        <i class="fa-solid fa-newspaper text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-primary mb-2">562</h3>
                    <p class="text-gray-600 font-inter text-sm">Berita Dipublikasikan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Kami -->
    <section id="layanan" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Layanan Unggulan Kami</h2>
                <div class="w-24 h-1 bg-accent mx-auto rounded-full"></div>
                <p class="text-gray-500 mt-4 max-w-2xl mx-auto font-inter">Kami menyediakan berbagai layanan digital untuk memudahkan masyarakat dalam mengurus keperluan administrasi dan pelaporan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Layanan 1 -->
                <div class="bg-background rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-xl hover:border-secondary transition-all duration-300 group cursor-pointer">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-secondary mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-id-card text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Registrasi SIM</h3>
                    <p class="text-gray-500 text-sm mb-6 font-inter leading-relaxed">Pengajuan pembuatan dan perpanjangan SIM secara online dengan mudah dan cepat.</p>
                    <a href="{{ route('user.layanan.sim') }}" class="inline-flex items-center text-secondary font-semibold group-hover:text-primary">
                        Daftar Sekarang <i class="fa-solid fa-arrow-right ml-2 transform group-hover:translate-x-2 transition-transform"></i>
                    </a>
                </div>

                <!-- Layanan 2 -->
                <div class="bg-background rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-xl hover:border-secondary transition-all duration-300 group cursor-pointer">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-secondary mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-car-side text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Perpanjangan STNK</h3>
                    <p class="text-gray-500 text-sm mb-6 font-inter leading-relaxed">Layanan pengesahan STNK tahunan dan perpanjangan dokumen kendaraan bermotor.</p>
                    <a href="{{ route('user.layanan.stnk') }}" class="inline-flex items-center text-secondary font-semibold group-hover:text-primary">
                        Daftar Sekarang <i class="fa-solid fa-arrow-right ml-2 transform group-hover:translate-x-2 transition-transform"></i>
                    </a>
                </div>

                <!-- Layanan 3 -->
                <div class="bg-background rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-xl hover:border-danger transition-all duration-300 group cursor-pointer">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-danger mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-shield-cat text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Pengaduan Masyarakat</h3>
                    <p class="text-gray-500 text-sm mb-6 font-inter leading-relaxed">Laporkan kejadian, tindak kriminal, atau ketidaknyamanan Anda langsung kepada kami.</p>
                    <a href="{{ route('user.layanan.pengaduan') }}" class="inline-flex items-center text-danger font-semibold group-hover:text-red-700">
                        Laporkan <i class="fa-solid fa-arrow-right ml-2 transform group-hover:translate-x-2 transition-transform"></i>
                    </a>
                </div>

                <!-- Layanan 4 (SKCK) -->
                <div class="bg-background rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-xl hover:border-green-500 transition-all duration-300 group cursor-pointer">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-green-500 mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-fingerprint text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">SKCK Online</h3>
                    <p class="text-gray-500 text-sm mb-6 font-inter leading-relaxed">Permohonan pembuatan dan perpanjangan Surat Keterangan Catatan Kepolisian lebih efisien.</p>
                    <a href="{{ route('user.layanan.skck') }}" class="inline-flex items-center text-green-500 font-semibold group-hover:text-green-700">
                        Buat Pengajuan <i class="fa-solid fa-arrow-right ml-2 transform group-hover:translate-x-2 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur Pelayanan (Horizontal Timeline) -->
    <section id="alur" class="py-20 bg-background relative overflow-hidden">
        <!-- Abstract shape -->
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-primary/5 rounded-full blur-3xl"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Alur Pelayanan Digital</h2>
                <div class="w-24 h-1 bg-accent mx-auto rounded-full"></div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center relative">
                <!-- Connecting Line -->
                <div class="hidden md:block absolute top-1/2 left-0 w-full h-1 bg-gray-200 -z-10 transform -translate-y-1/2"></div>
                
                <!-- Steps -->
                <div class="flex flex-col items-center mb-8 md:mb-0">
                    <div class="w-16 h-16 bg-primary text-white rounded-full flex items-center justify-center text-2xl font-bold mb-4 shadow-lg border-4 border-background z-10">1</div>
                    <h4 class="font-bold text-gray-800">Registrasi Akun</h4>
                    <p class="text-sm text-gray-500 font-inter mt-1 text-center">Buat akun SIPAWON</p>
                </div>
                <div class="flex flex-col items-center mb-8 md:mb-0">
                    <div class="w-16 h-16 bg-secondary text-white rounded-full flex items-center justify-center text-2xl font-bold mb-4 shadow-lg border-4 border-background z-10">2</div>
                    <h4 class="font-bold text-gray-800">Upload Berkas</h4>
                    <p class="text-sm text-gray-500 font-inter mt-1 text-center">Lengkapi dokumen</p>
                </div>
                <div class="flex flex-col items-center mb-8 md:mb-0">
                    <div class="w-16 h-16 bg-accent text-primary rounded-full flex items-center justify-center text-2xl font-bold mb-4 shadow-lg border-4 border-background z-10">3</div>
                    <h4 class="font-bold text-gray-800">Verifikasi</h4>
                    <p class="text-sm text-gray-500 font-inter mt-1 text-center">Pengecekan oleh petugas</p>
                </div>
                <div class="flex flex-col items-center mb-8 md:mb-0">
                    <div class="w-16 h-16 bg-primary text-white rounded-full flex items-center justify-center text-2xl font-bold mb-4 shadow-lg border-4 border-background z-10">4</div>
                    <h4 class="font-bold text-gray-800">Jadwal Pelayanan</h4>
                    <p class="text-sm text-gray-500 font-inter mt-1 text-center">Pilih waktu kedatangan</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-success text-white rounded-full flex items-center justify-center text-2xl font-bold mb-4 shadow-lg border-4 border-background z-10"><i class="fa-solid fa-check"></i></div>
                    <h4 class="font-bold text-gray-800">Selesai</h4>
                    <p class="text-sm text-gray-500 font-inter mt-1 text-center">Pelayanan tuntas</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita Terbaru -->
    <section id="berita" class="py-20 bg-white relative">
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Berita & Informasi Terbaru</h2>
                <div class="w-24 h-1 bg-accent mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($berita as $item)
                <div class="bg-background rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col group">
                    <div class="relative h-48 overflow-hidden bg-gray-200">
                        <a href="{{ route('berita.show', $item->slug) }}" class="block w-full h-full">
                            @if($item->thumbnail)
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400"><i class="fa-regular fa-image text-4xl"></i></div>
                            @endif
                        </a>
                        <div class="absolute top-4 left-4 bg-primary text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                            {{ $item->kategori->nama ?? 'Umum' }}
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <a href="{{ route('berita.show', $item->slug) }}" class="block">
                            <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-primary transition-colors">{{ $item->judul }}</h3>
                        </a>
                        <p class="text-gray-500 text-sm mb-4 font-inter flex-grow line-clamp-3">{{ $item->ringkasan }}</p>
                        <div class="flex justify-between items-center text-sm text-gray-400 font-inter mt-auto pt-4 border-t border-gray-200">
                            <span><i class="fa-regular fa-calendar mr-1"></i> {{ $item->created_at->format('d M Y') }}</span>
                            <a href="{{ route('berita.show', $item->slug) }}" class="text-secondary font-semibold hover:text-primary transition">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-1 md:col-span-3 text-center py-10 text-gray-500">
                    <div class="text-6xl text-gray-300 mb-4"><i class="fa-solid fa-newspaper"></i></div>
                    <p>Belum ada berita yang dipublikasikan.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary text-white pt-16 pb-8">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 object-contain">
                        <span class="text-2xl font-bold tracking-wider">SIPAWON</span>
                    </div>
                    <p class="text-gray-300 font-inter leading-relaxed mb-6 max-w-md">Sistem Pelayanan Polres Wonogiri (SIPAWON) hadir untuk memberikan kemudahan akses pelayanan publik yang transparan, cepat, dan terpercaya bagi seluruh masyarakat Wonogiri.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-accent hover:text-primary transition"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-accent hover:text-primary transition"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-accent hover:text-primary transition"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-accent hover:text-primary transition"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-6 text-accent">Layanan Cepat</h4>
                    <ul class="space-y-3 text-gray-300 font-inter">
                        <li><a href="#" class="hover:text-white transition">Registrasi SIM</a></li>
                        <li><a href="#" class="hover:text-white transition">Perpanjangan STNK</a></li>
                        <li><a href="#" class="hover:text-white transition">Pengaduan Masyarakat</a></li>
                        <li><a href="#" class="hover:text-white transition">SKCK Online</a></li>
                        <li><a href="#" class="hover:text-white transition">SP2HP</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-6 text-accent">Hubungi Kami</h4>
                    <ul class="space-y-4 text-gray-300 font-inter">
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-location-dot mt-1 text-accent"></i>
                            <span>Jl. Jend. Sudirman No.1, Wonokarto, Kec. Wonogiri, Kabupaten Wonogiri, Jawa Tengah 57612</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-phone text-accent"></i>
                            <span>(0273) 321110</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-envelope text-accent"></i>
                            <span>humas@polreswonogiri.go.id</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-white/20 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">&copy; 2026 Kepolisian Resor Wonogiri. Hak Cipta Dilindungi.</p>
                <div class="flex space-x-4 mt-4 md:mt-0 text-sm text-gray-400">
                    <a href="#" class="hover:text-white transition">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-white transition">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
