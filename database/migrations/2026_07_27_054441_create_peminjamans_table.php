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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel users dan cars (ganti 'cars' jika nama tabel mobilmu berbeda)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('car_id')->constrained('cars')->onDelete('cascade');
            
            // Detail Peminjaman
            $table->text('alasan');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            
            // Foto Bukti Peminjaman
            $table->string('foto_sebelum')->nullable();
            $table->string('foto_sesudah')->nullable();
            
            // Status Persetujuan Admin
            $table->enum('status', ['pending', 'disetujui', 'ditolak', 'selesai'])->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};