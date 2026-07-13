<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Masyarakat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-bold mb-2 text-primary font-poppins">Layanan Tersedia</h3>
                <p class="text-gray-500 mb-6 font-inter text-sm">Pilih layanan yang ingin Anda ajukan secara digital.</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <a href="#" class="block p-8 bg-background rounded-3xl hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-primary group">
                        <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-sm mb-4 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-id-card text-2xl text-secondary"></i>
                        </div>
                        <h4 class="font-bold text-gray-800 text-lg">Registrasi SIM</h4>
                        <p class="text-sm text-gray-500 mt-2 font-inter leading-relaxed">Ajukan permohonan pembuatan atau perpanjangan SIM dengan mudah.</p>
                    </a>
                    
                    <a href="#" class="block p-8 bg-background rounded-3xl hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-accent group">
                        <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-sm mb-4 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-car text-2xl text-accent"></i>
                        </div>
                        <h4 class="font-bold text-gray-800 text-lg">Perpanjangan STNK</h4>
                        <p class="text-sm text-gray-500 mt-2 font-inter leading-relaxed">Layanan pengesahan dan perpanjangan dokumen kendaraan bermotor Anda.</p>
                    </a>
                    
                    <a href="#" class="block p-8 bg-background rounded-3xl hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-danger group">
                        <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-sm mb-4 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-shield-halved text-2xl text-danger"></i>
                        </div>
                        <h4 class="font-bold text-gray-800 text-lg">Pengaduan Masyarakat</h4>
                        <p class="text-sm text-gray-500 mt-2 font-inter leading-relaxed">Laporkan kejadian, kecelakaan, atau tindak kriminal kepada pihak berwajib.</p>
                    </a>
                </div>
            </div>
            
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold font-poppins">Riwayat Pengajuan</h3>
                    <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-semibold">0 Pengajuan</span>
                </div>
                
                <div class="border-2 border-dashed border-gray-200 rounded-2xl p-12 text-center">
                    <i class="fa-regular fa-folder-open text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500 font-inter">Anda belum memiliki riwayat pengajuan layanan.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
