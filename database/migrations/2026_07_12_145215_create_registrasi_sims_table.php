<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('registrasi_sims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('nik');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->enum('jenis_sim', ['A', 'C', 'B1', 'B2', 'D']);
            $table->string('no_hp');
            $table->string('email');
            $table->string('ktp');
            $table->string('pas_foto');
            $table->string('surat_kesehatan');
            $table->string('surat_psikologi');
            $table->enum('status', ['menunggu', 'diverifikasi', 'ditolak', 'dijadwalkan', 'selesai'])->default('menunggu');
            $table->date('jadwal_pelayanan')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('registrasi_sims');
    }
};
