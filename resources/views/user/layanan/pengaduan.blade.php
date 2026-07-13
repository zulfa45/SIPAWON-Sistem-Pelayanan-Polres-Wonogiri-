<x-app-layout>
    <div class="py-12 bg-background min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl p-8 border border-gray-100">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-16 h-16 bg-danger/10 rounded-2xl flex items-center justify-center text-danger">
                        <i class="fa-solid fa-shield-cat text-3xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">Pengaduan Masyarakat</h2>
                        <p class="text-gray-500 font-inter">Laporkan tindak kejahatan atau kejadian kepada pihak berwajib.</p>
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

                <form action="{{ route('user.layanan.pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Judul Laporan</label>
                        <input type="text" name="judul" required class="w-full rounded-xl border-gray-300 focus:border-danger focus:ring focus:ring-danger/20 shadow-sm transition" placeholder="Contoh: Pencurian Kendaraan Bermotor di Pasar">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Kategori Kejadian</label>
                            <select name="kategori" required class="w-full rounded-xl border-gray-300 focus:border-danger focus:ring focus:ring-danger/20 shadow-sm transition">
                                <option value="Kriminalitas">Kriminalitas</option>
                                <option value="Kecelakaan">Kecelakaan Lalu Lintas</option>
                                <option value="Penipuan">Penipuan Online/Offline</option>
                                <option value="Ketertiban">Gangguan Ketertiban</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Kejadian</label>
                            <input type="date" name="tanggal_kejadian" required class="w-full rounded-xl border-gray-300 focus:border-danger focus:ring focus:ring-danger/20 shadow-sm transition">
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-sm font-bold text-gray-700">Titik Lokasi Kejadian (Peta)</label>
                            <button type="button" id="btn-sharelok" class="text-xs bg-danger/10 text-danger hover:bg-danger/20 font-bold px-3 py-1 rounded-full transition">
                                <i class="fa-solid fa-location-crosshairs mr-1"></i> Gunakan Lokasi Saat Ini
                            </button>
                        </div>
                        <!-- Container untuk Peta -->
                        <div id="map" class="w-full h-[300px] rounded-xl border border-gray-300 mb-3 z-0"></div>
                        <p class="text-xs text-gray-500 mb-2 italic">Geser pin merah atau klik pada peta untuk menentukan lokasi kejadian secara presisi.</p>
                        
                        <label class="block text-sm font-bold text-gray-700 mb-2 mt-4">Alamat Lengkap Kejadian</label>
                        <input type="text" name="lokasi" id="input-lokasi" required class="w-full rounded-xl border-gray-300 focus:border-danger focus:ring focus:ring-danger/20 shadow-sm transition" placeholder="Otomatis terisi setelah memilih titik di peta...">
                        <input type="hidden" name="latitude" id="input-latitude">
                        <input type="hidden" name="longitude" id="input-longitude">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Kronologi (Isi Laporan)</label>
                        <textarea name="isi" rows="5" required class="w-full rounded-xl border-gray-300 focus:border-danger focus:ring focus:ring-danger/20 shadow-sm transition" placeholder="Jelaskan detail kejadian yang Anda alami/lihat..."></textarea>
                    </div>

                    <div class="border-t border-gray-100 pt-6 mt-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4"><i class="fa-solid fa-file-arrow-up text-danger mr-2"></i> Lampirkan Bukti (Opsional namun sangat membantu)</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Bukti Foto</label>
                                <input type="file" name="foto" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-danger/10 file:text-danger hover:file:bg-danger/20 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Bukti Video</label>
                                <input type="file" name="video" accept="video/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-danger/10 file:text-danger hover:file:bg-danger/20 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Dokumen (PDF/DOC)</label>
                                <input type="file" name="dokumen" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-danger/10 file:text-danger hover:file:bg-danger/20 transition">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-6">
                        <a href="{{ route('home') }}" class="mr-4 px-6 py-3 text-gray-500 hover:text-gray-700 font-bold transition">Batal</a>
                        <button type="submit" class="bg-danger text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:bg-red-700 hover:shadow-xl transition hover:-translate-y-1">
                            Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    // Inisialisasi Peta (Default ke Alun-Alun Wonogiri)
    let map = L.map('map').setView([-7.8152, 110.9250], 13);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    let marker = L.marker([-7.8152, 110.9250], {draggable: true}).addTo(map);
    
    const inputLokasi = document.getElementById('input-lokasi');
    const inputLat = document.getElementById('input-latitude');
    const inputLng = document.getElementById('input-longitude');
    const btnSharelok = document.getElementById('btn-sharelok');

    // Fungsi untuk memperbarui koordinat & geocoding (mencari alamat)
    async function updateLocationInfo(lat, lng) {
        inputLat.value = lat;
        inputLng.value = lng;
        
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`);
            const data = await response.json();
            
            if(data && data.display_name) {
                inputLokasi.value = data.display_name;
            } else {
                inputLokasi.value = `Koordinat: ${lat}, ${lng}`;
            }
        } catch (error) {
            inputLokasi.value = `Koordinat: ${lat}, ${lng}`;
        }
    }

    // Event ketika marker digeser manual
    marker.on('dragend', function(e) {
        const position = marker.getLatLng();
        updateLocationInfo(position.lat, position.lng);
    });

    // Event ketika peta diklik
    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        updateLocationInfo(e.latlng.lat, e.latlng.lng);
    });

    // Tombol Gunakan Lokasi Saat Ini
    btnSharelok.addEventListener('click', function() {
        if (!navigator.geolocation) {
            alert('Browser Anda tidak mendukung deteksi lokasi (Geolocation).');
            return;
        }

        btnSharelok.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-1"></i> Mendeteksi...';
        btnSharelok.disabled = true;

        navigator.geolocation.getCurrentPosition(
            function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                
                // Geser peta dan marker ke lokasi pengguna
                map.setView([lat, lng], 16);
                marker.setLatLng([lat, lng]);
                
                updateLocationInfo(lat, lng);

                btnSharelok.innerHTML = '<i class="fa-solid fa-check mr-1"></i> Berhasil';
                setTimeout(() => {
                    btnSharelok.innerHTML = '<i class="fa-solid fa-location-crosshairs mr-1"></i> Gunakan Lokasi Saat Ini';
                    btnSharelok.disabled = false;
                }, 3000);
            },
            function(error) {
                alert('Gagal mendapatkan lokasi. Pastikan Anda memberikan izin akses lokasi pada browser.');
                btnSharelok.innerHTML = '<i class="fa-solid fa-location-crosshairs mr-1"></i> Gunakan Lokasi Saat Ini';
                btnSharelok.disabled = false;
            },
            {
                enableHighAccuracy: true,
                timeout: 10000
            }
        );
    });
</script>
