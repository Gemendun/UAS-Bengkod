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
        Schema::create('dokters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama', 100);
            $table->foreignId('poli_id')->constrained('polis')->onDelete('cascade');
            $table->string('alamat')->nullable(); // Tambahkan alamat di sini
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};
