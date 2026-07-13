<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center text-primary">
                <i class="fa-solid fa-user-gear text-xl"></i>
            </div>
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Pengaturan Profil') }}
                </h2>
                <p class="text-sm text-gray-500 font-inter">Kelola informasi pribadi dan keamanan akun Anda.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-background relative overflow-hidden">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8 relative z-10">
            
            <div class="p-8 bg-white shadow-xl sm:rounded-3xl border border-gray-100 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full blur-3xl -mr-10 -mt-10 group-hover:bg-primary/10 transition-colors"></div>
                <div class="max-w-xl relative z-10">
                    <div class="mb-6 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-800"><i class="fa-solid fa-address-card text-primary mr-2"></i> Informasi Akun</h3>
                        <p class="text-sm text-gray-500 mt-1 font-inter">Perbarui informasi profil dan alamat email akun Anda.</p>
                    </div>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-8 bg-white shadow-xl sm:rounded-3xl border border-gray-100 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-secondary/5 rounded-full blur-3xl -mr-10 -mt-10 group-hover:bg-secondary/10 transition-colors"></div>
                <div class="max-w-xl relative z-10">
                    <div class="mb-6 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-800"><i class="fa-solid fa-lock text-secondary mr-2"></i> Keamanan Sandi</h3>
                        <p class="text-sm text-gray-500 mt-1 font-inter">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
                    </div>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-8 bg-white shadow-xl sm:rounded-3xl border border-red-50 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-danger/5 rounded-full blur-3xl -mr-10 -mt-10 group-hover:bg-danger/10 transition-colors"></div>
                <div class="max-w-xl relative z-10">
                    <div class="mb-6 border-b border-red-50 pb-4">
                        <h3 class="text-lg font-bold text-danger"><i class="fa-solid fa-triangle-exclamation mr-2"></i> Zona Berbahaya</h3>
                        <p class="text-sm text-gray-500 mt-1 font-inter">Hapus akun Anda secara permanen beserta seluruh datanya.</p>
                    </div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
