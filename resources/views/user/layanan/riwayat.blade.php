<x-app-layout>
    <div class="py-12 bg-background min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center text-primary">
                        <i class="fa-solid fa-clock-rotate-left text-3xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">Riwayat Pengajuan Saya</h2>
                        <p class="text-gray-500 font-inter">Pantau status seluruh permohonan layanan publik dan pengaduan Anda.</p>
                    </div>
                </div>
                
                <form action="{{ route('user.riwayat') }}" method="GET" class="flex flex-col sm:flex-row gap-2 bg-white p-3 rounded-2xl border border-gray-100 shadow-sm">
                    <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" title="Tanggal Mulai" class="text-sm rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary/20">
                    <span class="self-center text-gray-500 text-sm hidden sm:inline">-</span>
                    <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" title="Tanggal Selesai" class="text-sm rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary/20">
                    <button type="submit" class="bg-primary text-white text-sm font-bold px-4 py-2 rounded-lg hover:bg-secondary transition"><i class="fa-solid fa-filter mr-1"></i> Filter</button>
                    @if(request('tanggal_awal') || request('tanggal_akhir'))
                        <a href="{{ route('user.riwayat') }}" class="bg-gray-100 text-gray-600 text-sm font-bold px-4 py-2 rounded-lg hover:bg-gray-200 transition inline-flex items-center justify-center"><i class="fa-solid fa-xmark"></i></a>
                    @endif
                </form>
            </div>

            @php
                $statusColors = [
                    'menunggu' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                    'diproses' => 'bg-blue-100 text-blue-700 border-blue-200',
                    'diverifikasi' => 'bg-blue-100 text-blue-700 border-blue-200',
                    'ditindaklanjuti' => 'bg-purple-100 text-purple-700 border-purple-200',
                    'dijadwalkan' => 'bg-purple-100 text-purple-700 border-purple-200',
                    'selesai' => 'bg-green-100 text-green-700 border-green-200',
                    'ditolak' => 'bg-red-100 text-red-700 border-red-200',
                ];
            @endphp

            <div class="space-y-8">
                <!-- Riwayat SIM -->
                <section>
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2"><i class="fa-solid fa-id-card text-primary mr-2"></i> Pengajuan SIM</h3>
                    @if($sim->isEmpty())
                        <div class="bg-white rounded-2xl p-6 text-center text-gray-500 shadow-sm border border-gray-100">Belum ada riwayat pengajuan SIM.</div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($sim as $item)
                                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
                                    <div class="flex justify-between items-start mb-4">
                                        <span class="text-xs font-bold text-gray-500">{{ $item->created_at->format('d M Y') }}</span>
                                        <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusColors[$item->status] ?? 'bg-gray-100 text-gray-700' }}">{{ ucfirst($item->status) }}</span>
                                    </div>
                                    <h4 class="font-bold text-lg text-gray-800 mb-2">SIM {{ $item->jenis_sim }} - {{ $item->nama }}</h4>
                                    
                                    @if($item->jadwal_pelayanan)
                                    <div class="mt-4 bg-primary/5 p-3 rounded-xl border border-primary/10">
                                        <p class="text-xs font-bold text-primary mb-1">Jadwal Kedatangan:</p>
                                        <p class="text-sm font-semibold text-gray-800"><i class="fa-regular fa-calendar-check mr-2"></i>{{ \Carbon\Carbon::parse($item->jadwal_pelayanan)->format('d F Y') }}</p>
                                    </div>
                                    @endif
                                    
                                    @if($item->catatan_admin)
                                    <div class="mt-4 text-sm text-gray-600 bg-gray-50 p-3 rounded-xl">
                                        <span class="font-bold block mb-1">Catatan Petugas:</span>
                                        {{ $item->catatan_admin }}
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>

                <!-- Riwayat STNK -->
                <section>
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2"><i class="fa-solid fa-car text-primary mr-2"></i> Perpanjangan STNK</h3>
                    @if($stnk->isEmpty())
                        <div class="bg-white rounded-2xl p-6 text-center text-gray-500 shadow-sm border border-gray-100">Belum ada riwayat perpanjangan STNK.</div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($stnk as $item)
                                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
                                    <div class="flex justify-between items-start mb-4">
                                        <span class="text-xs font-bold text-gray-500">{{ $item->created_at->format('d M Y') }}</span>
                                        <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusColors[$item->status] ?? 'bg-gray-100 text-gray-700' }}">{{ ucfirst($item->status) }}</span>
                                    </div>
                                    <h4 class="font-bold text-lg text-gray-800 mb-2">No. Polisi: <span class="text-secondary">{{ $item->no_polisi }}</span></h4>
                                    <p class="text-sm text-gray-600">STNK: {{ $item->no_stnk }}</p>
                                    
                                    @if($item->jadwal_pelayanan)
                                    <div class="mt-4 bg-primary/5 p-3 rounded-xl border border-primary/10">
                                        <p class="text-xs font-bold text-primary mb-1">Jadwal Kedatangan:</p>
                                        <p class="text-sm font-semibold text-gray-800"><i class="fa-regular fa-calendar-check mr-2"></i>{{ \Carbon\Carbon::parse($item->jadwal_pelayanan)->format('d F Y') }}</p>
                                    </div>
                                    @endif
                                    
                                    @if($item->catatan_admin)
                                    <div class="mt-4 text-sm text-gray-600 bg-gray-50 p-3 rounded-xl">
                                        <span class="font-bold block mb-1">Catatan Petugas:</span>
                                        {{ $item->catatan_admin }}
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>

                <!-- Riwayat SKCK -->
                <section>
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2"><i class="fa-solid fa-file-signature text-primary mr-2"></i> Pengajuan SKCK</h3>
                    @if(isset($skck) && $skck->isEmpty())
                        <div class="bg-white rounded-2xl p-6 text-center text-gray-500 shadow-sm border border-gray-100">Belum ada riwayat pengajuan SKCK.</div>
                    @elseif(isset($skck))
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($skck as $item)
                                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
                                    <div class="flex justify-between items-start mb-4">
                                        <span class="text-xs font-bold text-gray-500">{{ $item->created_at->format('d M Y') }}</span>
                                        <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusColors[$item->status] ?? 'bg-gray-100 text-gray-700' }}">{{ ucfirst($item->status) }}</span>
                                    </div>
                                    <h4 class="font-bold text-lg text-gray-800 mb-2">Keperluan: <span class="text-secondary">{{ $item->keperluan }}</span></h4>
                                    
                                    @if($item->jadwal_pengambilan)
                                    <div class="mt-4 bg-primary/5 p-3 rounded-xl border border-primary/10">
                                        <p class="text-xs font-bold text-primary mb-1">Jadwal Pengambilan SKCK:</p>
                                        <p class="text-sm font-semibold text-gray-800"><i class="fa-regular fa-calendar-check mr-2"></i>{{ \Carbon\Carbon::parse($item->jadwal_pengambilan)->format('d F Y') }}</p>
                                    </div>
                                    @endif
                                    
                                    @if($item->catatan_admin)
                                    <div class="mt-4 text-sm text-gray-600 bg-gray-50 p-3 rounded-xl">
                                        <span class="font-bold block mb-1">Catatan Petugas:</span>
                                        {{ $item->catatan_admin }}
                                    </div>
                                    @endif

                                    @if($item->status === 'selesai')
                                    <div class="mt-4 pt-4 border-t border-gray-100">
                                        <a href="{{ route('user.layanan.skck.export_pdf', $item->id) }}" target="_blank" class="flex items-center justify-center w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-xl shadow-sm transition">
                                            <i class="fa-solid fa-file-pdf mr-2"></i> Unduh SKCK Resmi
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>

                <!-- Riwayat Pengaduan -->
                <section>
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2"><i class="fa-solid fa-file-shield text-primary mr-2"></i> Laporan Pengaduan</h3>
                    @if($pengaduan->isEmpty())
                        <div class="bg-white rounded-2xl p-6 text-center text-gray-500 shadow-sm border border-gray-100">Belum ada riwayat laporan pengaduan.</div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($pengaduan as $item)
                                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition flex flex-col h-full">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <span class="text-xs font-bold text-gray-500 block mb-1">{{ $item->created_at->format('d M Y, H:i') }}</span>
                                            <span class="text-xs bg-gray-100 px-2 py-1 rounded text-gray-600">{{ $item->kategori }}</span>
                                        </div>
                                        <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusColors[$item->status] ?? 'bg-gray-100 text-gray-700' }}">{{ ucfirst($item->status) }}</span>
                                    </div>
                                    <h4 class="font-bold text-xl text-danger mb-2">{{ $item->judul }}</h4>
                                    <p class="text-sm text-gray-600 mb-4 line-clamp-3">{{ $item->isi }}</p>
                                    
                                    <div class="mt-auto">
                                        <p class="text-xs text-gray-500 mb-4"><i class="fa-solid fa-location-dot mr-1"></i> {{ $item->lokasi }}</p>
                                        
                                        @if($item->catatan_admin)
                                        <div class="text-sm text-gray-700 bg-blue-50 border border-blue-100 p-4 rounded-xl">
                                            <span class="font-bold block mb-1 text-blue-800"><i class="fa-solid fa-reply mr-2"></i>Tanggapan Petugas:</span>
                                            {{ $item->catatan_admin }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>
            </div>
            
        </div>
    </div>
</x-app-layout>
