<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Layanan SKCK Online') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-background min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 font-inter text-sm">
                                <th class="p-4 font-semibold">Tgl Pengajuan</th>
                                <th class="p-4 font-semibold">Pemohon</th>
                                <th class="p-4 font-semibold">Keperluan</th>
                                <th class="p-4 font-semibold">Berkas</th>
                                <th class="p-4 font-semibold">Status</th>
                                <th class="p-4 font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($data as $item)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="p-4 text-sm text-gray-600 font-inter">
                                        {{ $item->created_at->format('d M Y') }}<br>
                                        <span class="text-xs text-gray-400">{{ $item->created_at->format('H:i') }} WIB</span>
                                    </td>
                                    <td class="p-4">
                                        <p class="font-bold text-gray-800">{{ $item->nama }}</p>
                                        <p class="text-sm text-gray-500 font-inter">NIK: {{ $item->nik }}</p>
                                        <p class="text-xs text-gray-500 font-inter"><i class="fa-solid fa-phone"></i> {{ $item->no_hp }}</p>
                                        <p class="text-xs text-red-500 mt-1 font-bold">Riwayat: {{ $item->riwayat_kriminal }}</p>
                                    </td>
                                    <td class="p-4">
                                        <p class="text-sm text-gray-700 font-inter font-bold">{{ $item->keperluan }}</p>
                                        @if($item->riwayat_kriminal == 'Ada')
                                            <p class="text-xs text-red-600 font-inter mt-1">{{ $item->keterangan_kriminal }}</p>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        <div class="flex flex-col gap-2">
                                            <a href="{{ asset('storage/' . $item->ktp) }}" target="_blank" class="text-xs bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-full text-center transition flex justify-center items-center gap-1 font-bold">
                                                <i class="fa-solid fa-id-card"></i> KTP
                                            </a>
                                            <a href="{{ asset('storage/' . $item->kk) }}" target="_blank" class="text-xs bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-full text-center transition flex justify-center items-center gap-1 font-bold">
                                                <i class="fa-solid fa-users-rectangle"></i> KK
                                            </a>
                                            <a href="{{ asset('storage/' . $item->akta_kelahiran) }}" target="_blank" class="text-xs bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-full text-center transition flex justify-center items-center gap-1 font-bold">
                                                <i class="fa-solid fa-file-lines"></i> Akta
                                            </a>
                                            <a href="{{ asset('storage/' . $item->pas_foto) }}" target="_blank" class="text-xs bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-full text-center transition flex justify-center items-center gap-1 font-bold">
                                                <i class="fa-solid fa-image-portrait"></i> Foto
                                            </a>
                                            @if($item->sidik_jari)
                                                <a href="{{ asset('storage/' . $item->sidik_jari) }}" target="_blank" class="text-xs bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-full text-center transition flex justify-center items-center gap-1 font-bold text-green-600">
                                                    <i class="fa-solid fa-fingerprint"></i> Sidik Jari
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <span class="px-3 py-1 text-xs font-bold rounded-full 
                                            @if($item->status == 'menunggu') bg-yellow-100 text-yellow-700
                                            @elseif($item->status == 'diproses') bg-blue-100 text-blue-700
                                            @elseif($item->status == 'selesai') bg-green-100 text-green-700
                                            @else bg-red-100 text-red-700
                                            @endif
                                        ">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                        @if($item->jadwal_pengambilan)
                                            <div class="mt-2 text-xs font-bold text-gray-500 bg-gray-50 p-2 rounded-lg text-center">
                                                <i class="fa-regular fa-calendar-check mr-1 text-primary"></i> 
                                                {{ \Carbon\Carbon::parse($item->jadwal_pengambilan)->format('d M Y') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        <div class="flex items-center gap-2">
                                            <!-- Update Button -->
                                            <button onclick="document.getElementById('modal-update-{{ $item->id }}').classList.remove('hidden')" class="bg-primary text-white p-2 rounded-xl hover:bg-secondary transition shadow-sm text-sm flex items-center justify-center w-8 h-8" title="Update Status">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            
                                            <!-- Print/Export PDF Button -->
                                            <a href="{{ route('admin.skck.export_pdf', $item->id) }}" target="_blank" class="bg-red-500 text-white p-2 rounded-xl hover:bg-red-600 transition shadow-sm text-sm flex items-center justify-center w-8 h-8" title="Cetak SKCK PDF">
                                                <i class="fa-solid fa-file-pdf"></i>
                                            </a>
                                        </div>

                                        <!-- Update Modal -->
                                        <div id="modal-update-{{ $item->id }}" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden z-50 flex items-center justify-center">
                                            <div class="bg-white rounded-3xl p-8 max-w-md w-full mx-4 transform transition-all">
                                                <div class="flex justify-between items-center mb-6">
                                                    <h3 class="text-xl font-bold font-poppins text-gray-800">Update Status SKCK</h3>
                                                    <button onclick="document.getElementById('modal-update-{{ $item->id }}').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                                                        <i class="fa-solid fa-xmark text-xl"></i>
                                                    </button>
                                                </div>
                                                
                                                <form action="{{ route('admin.skck.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    
                                                    <div class="mb-4">
                                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                                                        <select name="status" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm" required>
                                                            <option value="menunggu" {{ $item->status == 'menunggu' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                                            <option value="diproses" {{ $item->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                            <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai / Bisa Diambil</option>
                                                            <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>Ditolak / Berkas Tidak Lengkap</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-4">
                                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jadwal Pengambilan (Opsional)</label>
                                                        <input type="date" name="jadwal_pengambilan" value="{{ $item->jadwal_pengambilan ? \Carbon\Carbon::parse($item->jadwal_pengambilan)->format('Y-m-d') : '' }}" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm">
                                                        <p class="text-xs text-gray-500 mt-1">Isi jika statusnya Diproses/Selesai untuk memberitahu warga kapan bisa diambil.</p>
                                                    </div>

                                                    <div class="mb-6">
                                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan untuk Pemohon (Opsional)</label>
                                                        <textarea name="catatan_admin" rows="3" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm" placeholder="Contoh: Berkas sudah lengkap, silakan datang membawa pas foto asli.">{{ $item->catatan_admin }}</textarea>
                                                    </div>

                                                    <div class="flex justify-end gap-3">
                                                        <button type="button" onclick="document.getElementById('modal-update-{{ $item->id }}').classList.add('hidden')" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 transition">Batal</button>
                                                        <button type="submit" class="px-5 py-2.5 bg-primary text-white rounded-xl font-bold hover:bg-secondary transition shadow-sm">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-gray-500 font-inter">
                                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <i class="fa-solid fa-folder-open text-3xl text-gray-300"></i>
                                        </div>
                                        Belum ada data pengajuan SKCK.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
