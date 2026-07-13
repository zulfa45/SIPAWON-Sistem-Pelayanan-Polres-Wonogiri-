<x-app-layout>
    <div class="py-12 bg-background min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl p-8 border border-gray-100">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center text-primary">
                        <i class="fa-solid fa-id-card text-3xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">Pengajuan SIM Baru / Perpanjangan</h2>
                        <p class="text-gray-500 font-inter">Isi formulir di bawah ini dengan data yang sebenar-benarnya.</p>
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

                <form action="{{ route('user.layanan.sim.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama', auth()->user()->name) }}" required class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">NIK</label>
                            <input type="text" name="nik" value="{{ old('nik', auth()->user()->nik) }}" required class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jenis SIM</label>
                            <select name="jenis_sim" required class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition">
                                <option value="A" {{ old('jenis_sim') == 'A' ? 'selected' : '' }}>SIM A</option>
                                <option value="C" {{ old('jenis_sim') == 'C' ? 'selected' : '' }}>SIM C</option>
                                <option value="B1" {{ old('jenis_sim') == 'B1' ? 'selected' : '' }}>SIM B1</option>
                                <option value="D" {{ old('jenis_sim') == 'D' ? 'selected' : '' }}>SIM D</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">No. HP Aktif</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp', auth()->user()->no_hp) }}" required class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap (Sesuai KTP)</label>
                            <textarea name="alamat" rows="1" required class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition">{{ old('alamat') }}</textarea>
                        </div>
                    </div>

                    <!-- Alamat replaced above -->

                    <div class="border-t border-gray-100 pt-6 mt-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4"><i class="fa-solid fa-file-arrow-up text-secondary mr-2"></i> Upload Berkas</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Foto KTP</label>
                                <input type="file" name="ktp" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Pas Foto</label>
                                <input type="file" name="pas_foto" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Surat Keterangan Sehat</label>
                                <input type="file" name="surat_kesehatan" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Hasil Tes Psikologi</label>
                                <input type="file" name="surat_psikologi" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-6">
                        <a href="{{ route('home') }}" class="mr-4 px-6 py-3 text-gray-500 hover:text-gray-700 font-bold transition">Batal</a>
                        <button type="submit" class="bg-primary text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:bg-secondary hover:shadow-xl transition hover:-translate-y-1">
                            Kirim Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
