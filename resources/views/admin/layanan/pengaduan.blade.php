<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Pengaduan Masyarakat') }}
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

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 mb-6 flex flex-wrap gap-4 items-end justify-between">
                <form action="{{ route('admin.pengaduan.index') }}" method="GET" class="flex flex-wrap gap-4 items-end w-full lg:w-auto">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1">Dari Tanggal</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="rounded-xl border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1">Sampai Tanggal</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="rounded-xl border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1">Status</label>
                        <select name="status" class="rounded-xl border-gray-300 text-sm focus:border-primary focus:ring-primary">
                            <option value="semua" {{ request('status') == 'semua' ? 'selected' : '' }}>Semua Status</option>
                            <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="ditindaklanjuti" {{ request('status') == 'ditindaklanjuti' ? 'selected' : '' }}>Ditindaklanjuti</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-secondary text-white px-5 py-2 rounded-xl text-sm font-bold hover:bg-opacity-90 transition">
                        <i class="fa-solid fa-filter mr-1"></i> Filter
                    </button>
                    @if(request('start_date') || request('status'))
                        <a href="{{ route('admin.pengaduan.index') }}" class="text-gray-500 hover:text-danger text-sm font-bold ml-2 underline">Reset</a>
                    @endif
                </form>

                <a href="{{ route('admin.pengaduan.export_pdf', request()->all()) }}" target="_blank" class="bg-danger text-white px-5 py-2 rounded-xl text-sm font-bold hover:bg-red-700 transition flex items-center gap-2 mt-4 lg:mt-0">
                    <i class="fa-solid fa-file-pdf"></i> Export PDF
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 font-inter text-sm">
                                <th class="p-4 font-semibold">Tgl Pengaduan</th>
                                <th class="p-4 font-semibold">Pelapor</th>
                                <th class="p-4 font-semibold">Judul / Kronologi</th>
                                <th class="p-4 font-semibold">Lokasi & Tgl Kejadian</th>
                                <th class="p-4 font-semibold">Bukti</th>
                                <th class="p-4 font-semibold">Status</th>
                                <th class="p-4 font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($data as $item)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="p-4 text-sm text-gray-600">{{ $item->created_at->format('d M Y') }}</td>
                                <td class="p-4">
                                    <p class="font-bold text-gray-800">{{ $item->user->name ?? 'Anonim' }}</p>
                                    <span class="text-xs bg-gray-200 px-2 py-1 rounded mt-1 inline-block">{{ $item->kategori }}</span>
                                </td>
                                <td class="p-4">
                                    <h4 class="font-bold text-gray-800">{{ $item->judul }}</h4>
                                    <p class="text-sm text-gray-500 line-clamp-2 mt-1">{{ $item->isi }}</p>
                                </td>
                                <td class="p-4 text-xs text-gray-500">
                                    <p class="font-semibold text-gray-700 mb-1"><i class="fa-regular fa-calendar mr-1"></i> {{ \Carbon\Carbon::parse($item->tanggal_kejadian)->translatedFormat('d M Y') }}</p>
                                    <p class="leading-relaxed"><i class="fa-solid fa-location-dot mr-1"></i> {{ $item->lokasi }}</p>
                                    @if($item->latitude && $item->longitude)
                                        <a href="https://www.google.com/maps/search/?api=1&query={{ $item->latitude }},{{ $item->longitude }}" target="_blank" class="text-primary hover:underline mt-1 inline-block font-bold">
                                            <i class="fa-solid fa-map-location-dot mr-1"></i> Buka Gmaps
                                        </a>
                                    @endif
                                </td>
                                <td class="p-4 text-sm text-blue-500 flex gap-2">
                                    @if($item->foto)<a href="{{ asset('storage/' . $item->foto) }}" target="_blank" class="p-2 bg-blue-50 rounded hover:bg-blue-100" title="Foto Bukti"><i class="fa-regular fa-image"></i></a>@endif
                                    @if($item->video)<a href="{{ asset('storage/' . $item->video) }}" target="_blank" class="p-2 bg-blue-50 rounded hover:bg-blue-100" title="Video Bukti"><i class="fa-solid fa-video"></i></a>@endif
                                    @if($item->dokumen)<a href="{{ asset('storage/' . $item->dokumen) }}" target="_blank" class="p-2 bg-blue-50 rounded hover:bg-blue-100" title="Dokumen Tambahan"><i class="fa-solid fa-file-pdf"></i></a>@endif
                                </td>
                                <td class="p-4">
                                    @php
                                        $statusColors = [
                                            'menunggu' => 'bg-yellow-100 text-yellow-700',
                                            'diproses' => 'bg-blue-100 text-blue-700',
                                            'ditindaklanjuti' => 'bg-purple-100 text-purple-700',
                                            'selesai' => 'bg-green-100 text-green-700',
                                            'ditolak' => 'bg-red-100 text-red-700',
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusColors[$item->status] ?? 'bg-gray-100' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <form action="{{ route('admin.pengaduan.update', $item->id) }}" method="POST" class="flex flex-col gap-2 min-w-[200px]">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="text-sm rounded-lg border-gray-300">
                                            <option value="menunggu" {{ $item->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                            <option value="diproses" {{ $item->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                            <option value="ditindaklanjuti" {{ $item->status == 'ditindaklanjuti' ? 'selected' : '' }}>Ditindaklanjuti</option>
                                            <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                        <input type="text" name="catatan_admin" value="{{ $item->catatan_admin }}" placeholder="Tanggapan Polisi..." class="text-sm rounded-lg border-gray-300">
                                        <button type="submit" class="bg-primary text-white text-xs px-3 py-2 rounded-lg font-bold hover:bg-secondary transition">Update</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-gray-500">Belum ada laporan pengaduan masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
