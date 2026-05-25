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
        Schema::create('appointments', function (Blueprint $table) {
    $table->id('id_janji');

    // RELASI KE JADWAL
    $table->foreignId('id_jadwal')
    ->constrained('jadwal_dokter', 'id_jadwal')
    ->onDelete('cascade');

    // RELASI KE PASIEN
    $table->foreignId('id_pasien')
        ->constrained('pasiens', 'id_pasien')
        ->onDelete('cascade');

    $table->date('tanggal_janji');

    $table->integer('nomor_antrian');

    $table->enum('status_janji', [
        'pending',
        'approved',
        'completed',
        'cancelled'
    ])->default('pending');

    $table->text('keluhan_utama');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
