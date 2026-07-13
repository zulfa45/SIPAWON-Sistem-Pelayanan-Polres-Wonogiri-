<x-app-layout>
    <div class="py-12 bg-background min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl p-8 border border-gray-100">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-16 h-16 bg-secondary/10 rounded-2xl flex items-center justify-center text-secondary">
                        <i class="fa-solid fa-car-side text-3xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">Perpanjangan STNK</h2>
                        <p class="text-gray-500 font-inter">Isi formulir untuk perpanjangan STNK tahunan kendaraan Anda.</p>
                    </div>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center">
                        <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.layanan.stnk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">No. Polisi (Plat)</label>
                            <input type="text" name="no_polisi" required class="w-full rounded-xl border-gray-300 focus:border-secondary focus:ring focus:ring-secondary/20 shadow-sm transition" placeholder="Contoh: AD 1234 XY">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">No. STNK</label>
                            <input type="text" name="no_stnk" required class="w-full rounded-xl border-gray-300 focus:border-secondary focus:ring focus:ring-secondary/20 shadow-sm transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">No. Mesin</label>
                            <input type="text" name="no_mesin" required class="w-full rounded-xl border-gray-300 focus:border-secondary focus:ring focus:ring-secondary/20 shadow-sm transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">No. Rangka</label>
                            <input type="text" name="no_rangka" required class="w-full rounded-xl border-gray-300 focus:border-secondary focus:ring focus:ring-secondary/20 shadow-sm transition">
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-6 mt-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4"><i class="fa-solid fa-file-arrow-up text-secondary mr-2"></i> Upload Berkas</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Foto KTP Pemilik</label>
                                <input type="file" name="ktp" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-secondary/10 file:text-secondary hover:file:bg-secondary/20 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Foto STNK Lama</label>
                                <input type="file" name="stnk_lama" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-secondary/10 file:text-secondary hover:file:bg-secondary/20 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Foto BPKB (Opsional)</label>
                                <input type="file" name="bpkb" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-secondary/10 file:text-secondary hover:file:bg-secondary/20 transition">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-6">
                        <a href="{{ route('home') }}" class="mr-4 px-6 py-3 text-gray-500 hover:text-gray-700 font-bold transition">Batal</a>
                        <button type="submit" class="bg-secondary text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:bg-primary hover:shadow-xl transition hover:-translate-y-1">
                            Kirim Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
