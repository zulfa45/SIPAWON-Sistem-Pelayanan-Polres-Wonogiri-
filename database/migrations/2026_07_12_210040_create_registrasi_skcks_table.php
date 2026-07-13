<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registrasi_skcks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->string('nik', 16);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('agama');
            $table->string('kebangsaan')->default('WNI');
            $table->text('alamat');
            $table->string('no_hp');
            $table->string('keperluan');
            $table->enum('riwayat_kriminal', ['Tidak Ada', 'Ada']);
            $table->text('keterangan_kriminal')->nullable();
            
            // Berkas lampiran
            $table->string('ktp');
            $table->string('kk');
            $table->string('akta_kelahiran');
            $table->string('pas_foto');
            $table->string('sidik_jari')->nullable();
            
            // Status dan catatan admin
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'ditolak'])->default('menunggu');
            $table->text('catatan_admin')->nullable();
            $table->dateTime('jadwal_pengambilan')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrasi_skcks');
    }
};
