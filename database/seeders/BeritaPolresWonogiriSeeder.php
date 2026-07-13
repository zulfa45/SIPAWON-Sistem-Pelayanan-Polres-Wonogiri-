<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\User;

class BeritaPolresWonogiriSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first() ?? User::first();
        
        // Define Categories
        $categories = ['Kriminalitas', 'Lalu Lintas', 'Himbauan Kamtibmas', 'Kegiatan Polres', 'Pelayanan Publik'];
        $catIds = [];
        
        foreach ($categories as $cat) {
            $kategori = KategoriBerita::firstOrCreate(
                ['nama' => $cat],
                ['slug' => Str::slug($cat)]
            );
            $catIds[$cat] = $kategori->id;
        }

        $beritaData = [
            [
                'judul' => 'Polres Wonogiri Berhasil Ungkap Sindikat Curanmor Antar Provinsi',
                'kategori' => 'Kriminalitas',
                'isi' => 'Tim Resmob Satreskrim Polres Wonogiri berhasil menangkap tiga tersangka yang merupakan komplotan sindikat pencurian kendaraan bermotor (curanmor) lintas provinsi. Penangkapan dilakukan di wilayah perbatasan Wonogiri - Pacitan. Kapolres Wonogiri menegaskan komitmennya untuk terus memberantas kejahatan jalanan demi keamanan dan kenyamanan masyarakat.',
            ],
            [
                'judul' => 'Operasi Patuh Candi 2026: Ratusan Kendaraan Terjaring Razia Knalpot Brong',
                'kategori' => 'Lalu Lintas',
                'isi' => 'Satlantas Polres Wonogiri terus menggencarkan penindakan terhadap kendaraan roda dua yang menggunakan knalpot tidak sesuai spesifikasi teknis (brong). Selama sepekan Operasi Patuh Candi 2026, lebih dari 150 kendaraan telah diamankan. Kasat Lantas menghimbau warga untuk selalu menaati peraturan lalu lintas dan menggunakan komponen kendaraan yang standar.',
            ],
            [
                'judul' => 'Jumat Curhat, Kapolres Wonogiri Dengarkan Keluhan Warga Baturetno',
                'kategori' => 'Kegiatan Polres',
                'isi' => 'Melanjutkan program unggulan Polri "Jumat Curhat", Kapolres Wonogiri beserta jajaran pejabat utama (PJU) menyambangi Kecamatan Baturetno. Warga berdialog langsung dengan kepolisian terkait masalah keamanan lingkungan dan peredaran miras. Kapolres berjanji akan menindaklanjuti keluhan tersebut dengan meningkatkan patroli malam.',
            ],
            [
                'judul' => 'Waspada Penipuan Online, Polres Wonogiri Berikan Tips Aman Bertransaksi',
                'kategori' => 'Himbauan Kamtibmas',
                'isi' => 'Menyusul meningkatnya angka laporan penipuan melalui media sosial dan aplikasi perpesanan, Polres Wonogiri mengeluarkan himbauan resmi. Masyarakat diminta untuk tidak mudah percaya dengan tawaran hadiah, pinjaman online ilegal, atau pihak yang meminta transfer sejumlah uang dengan alasan darurat.',
            ],
            [
                'judul' => 'Kini Lebih Mudah, Urus SKCK di Polres Wonogiri Bisa Lewat Aplikasi SIPELITA',
                'kategori' => 'Pelayanan Publik',
                'isi' => 'Satuan Intelkam Polres Wonogiri resmi mengintegrasikan layanan pengajuan Surat Keterangan Catatan Kepolisian (SKCK) melalui sistem SIPELITA. Warga kini dapat mendaftar dari rumah, mengunggah persyaratan, dan hanya perlu datang untuk pengambilan dokumen fisik. Inovasi ini memangkas waktu tunggu secara signifikan.',
            ],
            [
                'judul' => 'Sambut HUT Bhayangkara, Polres Wonogiri Gelar Donor Darah Massal',
                'kategori' => 'Kegiatan Polres',
                'isi' => 'Ratusan personel Polres Wonogiri mendonorkan darahnya dalam rangka menyambut Hari Ulang Tahun (HUT) Bhayangkara. Bekerja sama dengan PMI Kabupaten Wonogiri, kegiatan ini berhasil mengumpulkan lebih dari 250 kantong darah. Kegiatan ini merupakan wujud bakti sosial kepolisian kepada masyarakat.',
            ],
            [
                'judul' => 'Penertiban Balap Liar di Seputaran Waduk Gajah Mungkur',
                'kategori' => 'Lalu Lintas',
                'isi' => 'Merespons laporan masyarakat via aplikasi SIPELITA terkait maraknya aksi balap liar pada akhir pekan, petugas gabungan Polres Wonogiri melakukan razia dadakan di jalan sekitar Waduk Gajah Mungkur. Puluhan pemuda beserta sepeda motornya dibawa ke Mako Polres untuk pendataan dan pembinaan.',
            ],
            [
                'judul' => 'Polres Wonogiri Bagikan Sembako untuk Warga Terdampak Kekeringan di Paranggupito',
                'kategori' => 'Kegiatan Polres',
                'isi' => 'Musim kemarau panjang berdampak pada krisis air bersih di wilayah Paranggupito. Jajaran Polres Wonogiri turun langsung memberikan bantuan air bersih sebanyak 10 tangki dan ratusan paket sembako untuk meringankan beban warga sekitar.',
            ],
            [
                'judul' => 'Bhabinkamtibmas Jatisrono Sukses Damaikan Perselisihan Warga Lewat Restorative Justice',
                'kategori' => 'Kriminalitas',
                'isi' => 'Pendekatan Restorative Justice kembali membuahkan hasil. Seorang Bhabinkamtibmas di Polsek Jatisrono berhasil memediasi dua keluarga yang bertikai akibat kesalahpahaman batas tanah. Kedua belah pihak sepakat berdamai tanpa harus menempuh jalur hukum formal.',
            ],
            [
                'judul' => 'Himbauan Cuaca Ekstrem: Warga Pesisir Selatan Diingatkan Waspada Gelombang Tinggi',
                'kategori' => 'Himbauan Kamtibmas',
                'isi' => 'Satpolairud Polres Wonogiri mengeluarkan peringatan dini terkait cuaca ekstrem dan potensi gelombang tinggi di perairan pantai selatan (Pantai Nampu dan Sembukan). Nelayan dan wisatawan diimbau untuk tidak melaut dan menjauhi bibir pantai untuk sementara waktu.',
            ]
        ];

        foreach ($beritaData as $data) {
            Berita::create([
                'user_id' => $admin->id,
                'kategori_berita_id' => $catIds[$data['kategori']],
                'judul' => $data['judul'],
                'slug' => Str::slug($data['judul']),
                'isi' => '<p>' . $data['isi'] . '</p>', // Basic HTML wrapping
                'thumbnail' => null, // User will add image later
                'status' => 'published',
                'created_at' => now()->subDays(rand(0, 30)),
            ]);
        }
    }
}
