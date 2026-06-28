<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('periksas', function (Blueprint $table) {
            $table->id();

            // Relasi ke pasien (users)
            $table->foreignId('id_pasien')->constrained('users')->onDelete('cascade');

            // Relasi ke jadwal periksa
            $table->foreignId('id_jadwal')->constrained('jadwal_periksas')->onDelete('cascade');

            // Waktu periksa & informasi tambahan
            $table->dateTime('tgl_periksa');

            // Keluhan dari pasien
            $table->text('keluhan')->nullable();

            // Catatan/diagnosa dari dokter
            $table->text('catatan_dokter')->nullable();

            // Biaya periksa & antrian
            $table->integer('biaya_periksa')->default(0);
            $table->integer('nomor_antrian');

            // Status pemeriksaan
            $table->string('status')->default('menunggu');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('periksas');
    }
};
