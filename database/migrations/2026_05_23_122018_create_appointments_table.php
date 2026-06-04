<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
    $table->id('id_janji');

    $table->foreignId('id_jadwal')
        ->constrained('jadwal_dokters', 'id_jadwal')
        ->onDelete('cascade');

    $table->foreignId('id_pasien')
        ->constrained('pasiens', 'id_pasien')
        ->onDelete('cascade');

    // 🔥 TAMBAHAN INI
    $table->foreignId('id_dokter')
        ->constrained('dokters', 'id_dokter')
        ->onDelete('cascade');

    $table->date('tanggal_janji');
    $table->integer('nomor_antrian');

    $table->enum('status_janji', [
    'pending',
    'called',
    'in_consultation',
    'completed',
    'cancelled'
])->default('pending');

    $table->text('keluhan_utama');

    $table->timestamps();
}
);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
