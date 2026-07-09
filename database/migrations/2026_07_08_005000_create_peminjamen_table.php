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
        // Membuat tabel dengan nama 'peminjaman'
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('mobil');
            $table->date('tanggal_mulai');
            $table->date('tanggal_kembali');
            $table->text('keperluan');
            $table->string('status')->default('Menunggu Persetujuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};