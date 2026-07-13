<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Main Content -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-8 mb-6 border border-gray-100">
        <h3 class="text-xl font-bold mb-6 font-poppins text-gray-800">Statistik Pelayanan</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-6 bg-blue-50 rounded-2xl flex items-center justify-between group hover:-translate-y-1 transition-transform">
                <div>
                    <h4 class="text-sm text-gray-500 font-inter mb-1 font-semibold">Total Pengaduan</h4>
                    <p class="text-4xl font-bold text-primary">{{ $totalPengaduan }}</p>
                </div>
                <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center text-primary text-2xl shadow-sm group-hover:bg-primary group-hover:text-white transition-colors">
                    <i class="fa-solid fa-file-shield"></i>
                </div>
            </div>
            
            <div class="p-6 bg-green-50 rounded-2xl flex items-center justify-between group hover:-translate-y-1 transition-transform">
                <div>
                    <h4 class="text-sm text-gray-500 font-inter mb-1 font-semibold">Registrasi SIM</h4>
                    <p class="text-4xl font-bold text-success">{{ $totalSim }}</p>
                </div>
                <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center text-success text-2xl shadow-sm group-hover:bg-success group-hover:text-white transition-colors">
                    <i class="fa-solid fa-id-card"></i>
                </div>
            </div>
            
            <div class="p-6 bg-yellow-50 rounded-2xl flex items-center justify-between group hover:-translate-y-1 transition-transform">
                <div>
                    <h4 class="text-sm text-gray-500 font-inter mb-1 font-semibold">Registrasi STNK</h4>
                    <p class="text-4xl font-bold text-accent">{{ $totalStnk }}</p>
                </div>
                <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center text-accent text-2xl shadow-sm group-hover:bg-accent group-hover:text-white transition-colors">
                    <i class="fa-solid fa-car"></i>
                </div>
            </div>

            <div class="p-6 bg-emerald-50 rounded-2xl flex items-center justify-between group hover:-translate-y-1 transition-transform">
                <div>
                    <h4 class="text-sm text-gray-500 font-inter mb-1 font-semibold">SKCK Online</h4>
                    <p class="text-4xl font-bold text-emerald-500">{{ $totalSkck }}</p>
                </div>
                <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center text-emerald-500 text-2xl shadow-sm group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                    <i class="fa-solid fa-fingerprint"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-8 border border-gray-100">
        <h3 class="text-xl font-bold mb-4 font-poppins text-gray-800">Aktivitas Terbaru</h3>
        <div class="border-2 border-dashed border-gray-100 rounded-xl p-8 text-center">
            <i class="fa-solid fa-clock-rotate-left text-4xl text-gray-300 mb-3"></i>
            <p class="text-gray-500 text-sm font-inter">Belum ada aktivitas terbaru hari ini.</p>
        </div>
    </div>
</x-admin-layout>
