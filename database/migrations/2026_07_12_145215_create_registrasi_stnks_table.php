<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('registrasi_stnks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('no_polisi');
            $table->string('no_stnk');
            $table->string('no_mesin');
            $table->string('no_rangka');
            $table->string('ktp');
            $table->string('stnk_lama');
            $table->string('bpkb')->nullable();
            $table->string('dokumen_pendukung')->nullable();
            $table->enum('status', ['menunggu', 'diverifikasi', 'ditolak', 'dijadwalkan', 'selesai'])->default('menunggu');
            $table->date('jadwal_pelayanan')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('registrasi_stnks');
    }
};
