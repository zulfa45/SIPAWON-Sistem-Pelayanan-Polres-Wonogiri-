<p align="center">
  <img src="public/images/logo-polri.png" alt="Logo Polri" width="150">
</p>

<h1 align="center">SIPAWON (Sistem Pelayanan Polres Wonogiri) 👮‍♂️</h1>

<p align="center">
  Platform aplikasi berbasis web untuk digitalisasi dan mempermudah layanan kepolisian bagi masyarakat di wilayah hukum Kabupaten Wonogiri.
</p>

---

## 🌟 Tentang SIPAWON

**SIPAWON (Sistem Pelayanan Polres Wonogiri)** adalah inisiatif "Kantor Polisi Virtual" yang dirancang menggunakan framework Laravel. Sistem ini mengintegrasikan berbagai layanan kepolisian sehingga masyarakat Wonogiri dapat mengurus administrasi dan melaporkan kejadian langsung dari perangkat mereka dengan lebih mudah, cepat, dan transparan.

## ✨ Fitur Utama

### 👮‍♂️ Untuk Masyarakat (User)
* **Pengajuan SKCK Online:** Formulir lengkap dengan integrasi unggah pas foto. Jika disetujui, warga dapat mencetak Sertifikat SKCK resmi berformat PDF.
* **Perpanjangan SIM & STNK:** Pendaftaran dan penyerahan berkas awal secara digital.
* **Laporan Pengaduan Terpadu:** Sistem pelaporan insiden/kejadian yang mendukung unggah foto bukti dan titik koordinat lokasi.
* **Riwayat & Pelacakan (Tracking):** Memantau status pengajuan (*Menunggu, Diproses, Dijadwalkan, Selesai, Ditolak*).
* **Portal Berita Kamtibmas:** Akses cepat ke informasi, berita, dan himbauan Kamtibmas terbaru dari Polres Wonogiri.

### 🛡️ Untuk Petugas (Admin Panel)
* **Dashboard Statistik Real-time:** Memantau jumlah total pengajuan harian secara sekilas.
* **Manajemen Pengajuan Terpusat:** Verifikasi berkas warga, penentuan jadwal kedatangan, dan pemberian catatan/instruksi.
* **Export & Cetak PDF Otomatis:** Fitur konversi data ke format dokumen resmi Polri (SKCK, Laporan Pengaduan) yang presisi (mendukung konfigurasi margin 1 halaman dan output foto).
* **Manajemen Konten Berita (CMS):** Pembuatan dan pengelolaan artikel berita kepolisian.

## 💻 Tech Stack (Teknologi)

* **Backend:** Laravel 12.x (PHP 8.2)
* **Frontend:** Blade Templating, Tailwind CSS, Alpine.js
* **Database:** MySQL
* **PDF Generator:** barryvdh/laravel-dompdf
* **Icon:** FontAwesome

## 🚀 Cara Instalasi (Local Development)

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek SIPAWON di komputer Anda (Localhost).

### Persyaratan Sistem:
- **PHP** >= 8.2 (Pastikan Ekstensi **GD** diaktifkan di `php.ini` untuk merender PDF & Gambar)
- **Composer** 
- **Node.js & NPM**
- **MySQL** / MariaDB

### Langkah Instalasi:

1. **Clone Repositori:**
   ```bash
   git clone https://github.com/zulfa45/SIPAWON-Sistem-Pelayanan-Polres-Wonogiri-.git
   cd SIPAWON-Sistem-Pelayanan-Polres-Wonogiri-
   ```

2. **Install Dependensi PHP & Node.js:**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment:**
   Salin file konfigurasi lalu sesuaikan pengaturan database Anda (terutama `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Siapkan Database & Jalankan Migrasi:**
   Buat database baru di MySQL (misal: `sipawon`), kemudian jalankan perintah migrasi beserta seeder (data *dummy* bawaan):
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Symlink Storage (Untuk Gambar):**
   Agar foto profil dan foto unggahan warga dapat diakses oleh publik:
   ```bash
   php artisan storage:link
   ```

6. **Jalankan Aplikasi:**
   Buka dua jendela terminal. Terminal 1 untuk menjalankan server PHP, Terminal 2 untuk memantau Tailwind CSS.
   ```bash
   # Terminal 1
   php artisan serve

   # Terminal 2
   npm run dev
   ```

7. **Akses Website:**
   Buka browser Anda dan kunjungi: `http://localhost:8000`

## 🔑 Akses Login (Default)

Saat sistem pertama kali dijalankan menggunakan Seeder, akun berikut akan otomatis dibuat:

**Akun Administrator (Petugas/Polisi):**
* **Email:** `admin@example.com`
* **Password:** `password`

**Akun Masyarakat Umum (User):**
* **Email:** `test@example.com`
* **Password:** `password`

---
> *Dikembangkan untuk Polres Wonogiri.* 🇮🇩
