<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Perpanjangan STNK') }}
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
                                <th class="p-4 font-semibold">Pemilik / Kendaraan</th>
                                <th class="p-4 font-semibold">Data Kendaraan</th>
                                <th class="p-4 font-semibold">Berkas</th>
                                <th class="p-4 font-semibold">Jadwal Pelayanan</th>
                                <th class="p-4 font-semibold">Status</th>
                                <th class="p-4 font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($data as $item)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="p-4 text-sm text-gray-600">{{ $item->created_at->format('d M Y, H:i') }}</td>
                                <td class="p-4">
                                    <p class="font-bold text-gray-800">{{ $item->user->name ?? 'User Terhapus' }}</p>
                                    <p class="font-bold text-secondary">{{ $item->no_polisi }}</p>
                                </td>
                                <td class="p-4 text-xs text-gray-600">
                                    <p>STNK: {{ $item->no_stnk }}</p>
                                    <p>Mesin: {{ $item->no_mesin }}</p>
                                    <p>Rangka: {{ $item->no_rangka }}</p>
                                </td>
                                <td class="p-4 text-sm text-blue-500">
                                    <div class="flex flex-col gap-1">
                                        <a href="{{ asset('storage/' . $item->ktp) }}" target="_blank" class="hover:underline">KTP</a>
                                        <a href="{{ asset('storage/' . $item->stnk_lama) }}" target="_blank" class="hover:underline">STNK Lama</a>
                                        @if($item->bpkb)<a href="{{ asset('storage/' . $item->bpkb) }}" target="_blank" class="hover:underline">BPKB</a>@endif
                                    </div>
                                </td>
                                <td class="p-4">
                                    @if($item->jadwal_pelayanan)
                                        <span class="text-sm font-semibold text-gray-700">{{ \Carbon\Carbon::parse($item->jadwal_pelayanan)->format('d M Y') }}</span>
                                    @else
                                        <span class="text-xs text-gray-400">Belum diatur</span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    @php
                                        $statusColors = [
                                            'menunggu' => 'bg-yellow-100 text-yellow-700',
                                            'diverifikasi' => 'bg-blue-100 text-blue-700',
                                            'dijadwalkan' => 'bg-purple-100 text-purple-700',
                                            'selesai' => 'bg-green-100 text-green-700',
                                            'ditolak' => 'bg-red-100 text-red-700',
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusColors[$item->status] ?? 'bg-gray-100' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <form action="{{ route('admin.stnk.update', $item->id) }}" method="POST" class="flex flex-col gap-2 min-w-[200px]">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="text-sm rounded-lg border-gray-300">
                                            <option value="menunggu" {{ $item->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                            <option value="diverifikasi" {{ $item->status == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                                            <option value="dijadwalkan" {{ $item->status == 'dijadwalkan' ? 'selected' : '' }}>Dijadwalkan</option>
                                            <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                        <input type="date" name="jadwal_pelayanan" value="{{ $item->jadwal_pelayanan }}" class="text-sm rounded-lg border-gray-300" title="Jadwal Kedatangan">
                                        <input type="text" name="catatan_admin" value="{{ $item->catatan_admin }}" placeholder="Catatan opsional..." class="text-sm rounded-lg border-gray-300">
                                        <button type="submit" class="bg-primary text-white text-xs px-3 py-2 rounded-lg font-bold hover:bg-secondary transition">Update</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-gray-500">Belum ada pengajuan perpanjangan STNK.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
