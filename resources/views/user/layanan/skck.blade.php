<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 font-poppins">Pengajuan SKCK Online</h2>
                    <p class="text-gray-500 mt-2 font-inter">Isi formulir di bawah ini dengan data yang valid untuk permohonan Surat Keterangan Catatan Kepolisian.</p>
                </div>
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary transition flex items-center gap-2 font-semibold bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-100">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl shadow-sm mb-6 font-inter">
                    <p class="font-bold mb-2 flex items-center gap-2"><i class="fa-solid fa-triangle-exclamation"></i> Terdapat kesalahan pengisian:</p>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <form action="{{ route('user.layanan.skck.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf
                    
                    <div class="mb-8 pb-4 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 font-poppins flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center">1</div>
                            Data Diri Pemohon
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" name="nama" value="{{ old('nama', auth()->user()->name) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition" required placeholder="Sesuai KTP">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">NIK</label>
                                <input type="text" name="nik" value="{{ old('nik', auth()->user()->nik) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition" required placeholder="16 Digit NIK" maxlength="16">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition" required placeholder="Kota Kelahiran">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition" required>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Agama</label>
                                <select name="agama" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition" required>
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen Protestan</option>
                                    <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Kebangsaan</label>
                                <input type="text" name="kebangsaan" value="{{ old('kebangsaan', 'WNI') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition" required>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor HP/WhatsApp</label>
                                <input type="text" name="no_hp" value="{{ old('no_hp', auth()->user()->no_hp) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition" required placeholder="Contoh: 08123456789">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                                <textarea name="alamat" rows="3" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition" required placeholder="Sesuai KTP (Jalan, RT/RW, Desa, Kecamatan)">{{ old('alamat', auth()->user()->alamat) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8 pb-4 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 font-poppins flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center">2</div>
                            Keperluan & Riwayat Tindak Pidana
                        </h3>
                        
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tujuan Pembuatan SKCK</label>
                                <input type="text" name="keperluan" value="{{ old('keperluan') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition" required placeholder="Contoh: Melamar Pekerjaan BUMN, Melanjutkan Pendidikan">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Apakah Anda pernah tersangkut perkara pidana?</label>
                                <div class="flex gap-4">
                                    <label class="flex items-center gap-2 cursor-pointer bg-gray-50 px-4 py-3 rounded-xl border border-gray-200 hover:bg-gray-100 transition">
                                        <input type="radio" name="riwayat_kriminal" value="Tidak Ada" {{ old('riwayat_kriminal', 'Tidak Ada') == 'Tidak Ada' ? 'checked' : '' }} class="text-primary focus:ring-primary" onclick="document.getElementById('keterangan_kriminal_div').classList.add('hidden')">
                                        <span class="text-sm font-semibold">Tidak Pernah</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer bg-gray-50 px-4 py-3 rounded-xl border border-gray-200 hover:bg-gray-100 transition">
                                        <input type="radio" name="riwayat_kriminal" value="Ada" {{ old('riwayat_kriminal') == 'Ada' ? 'checked' : '' }} class="text-primary focus:ring-primary" onclick="document.getElementById('keterangan_kriminal_div').classList.remove('hidden')">
                                        <span class="text-sm font-semibold">Pernah</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div id="keterangan_kriminal_div" class="{{ old('riwayat_kriminal') == 'Ada' ? '' : 'hidden' }}">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan Perkara Pidana</label>
                                <textarea name="keterangan_kriminal" rows="3" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition" placeholder="Sebutkan jenis perkara dan putusan pengadilan (jika ada)">{{ old('keterangan_kriminal') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-800 font-poppins flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center">3</div>
                            Unggah Dokumen Syarat
                        </h3>
                        
                        <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-xl mb-6 text-sm flex gap-3">
                            <i class="fa-solid fa-circle-info mt-1"></i>
                            <div>
                                <p class="font-bold">Ketentuan File:</p>
                                <ul class="list-disc list-inside mt-1">
                                    <li>Format gambar (JPG, PNG) atau PDF.</li>
                                    <li>Ukuran maksimal 2MB per file.</li>
                                    <li>Pastikan foto/dokumen jelas dan dapat dibaca.</li>
                                </ul>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Scan/Foto KTP <span class="text-red-500">*</span></label>
                                <input type="file" name="ktp" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-secondary cursor-pointer" required accept="image/*,.pdf">
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Scan/Foto Kartu Keluarga <span class="text-red-500">*</span></label>
                                <input type="file" name="kk" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-secondary cursor-pointer" required accept="image/*,.pdf">
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Scan/Foto Akta Kelahiran/Ijazah <span class="text-red-500">*</span></label>
                                <input type="file" name="akta_kelahiran" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-secondary cursor-pointer" required accept="image/*,.pdf">
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Pas Foto 4x6 (Latar Merah) <span class="text-red-500">*</span></label>
                                <input type="file" name="pas_foto" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-secondary cursor-pointer" required accept="image/*">
                            </div>

                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Rumus Sidik Jari (Opsional)</label>
                                <input type="file" name="sidik_jari" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300 cursor-pointer" accept="image/*,.pdf">
                                <p class="text-xs text-gray-500 mt-2">Lampirkan jika sudah memiliki kartu rumus sidik jari dari kepolisian.</p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex items-center justify-between">
                        <p class="text-sm text-gray-500 w-2/3">Dengan menekan tombol kirim, saya menyatakan bahwa data dan dokumen yang saya lampirkan adalah benar dan dapat dipertanggungjawabkan.</p>
                        <button type="submit" class="bg-primary hover:bg-secondary text-white font-bold py-3 px-8 rounded-xl transition shadow-sm hover:shadow-md flex items-center gap-2">
                            <i class="fa-solid fa-paper-plane"></i> Kirim Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
