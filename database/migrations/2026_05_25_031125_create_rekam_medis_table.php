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
        Schema::create('rekam_medis', function (Blueprint $table) {
    $table->id('id_rekam_medis');

    $table->foreignId('id_janji')
        ->constrained('appointments', 'id_janji')
        ->onDelete('cascade');

    $table->foreignId('id_dokter')
        ->constrained('dokters', 'id_dokter')
        ->onDelete('cascade');

    // 🔥 TAMBAHAN PENTING (HARUS ADA)
    $table->foreignId('id_pasien')
        ->constrained('pasiens', 'id_pasien')
        ->onDelete('cascade');

    $table->text('keluhan');
    $table->text('diagnosa');
    $table->text('catatan_dokter')->nullable();

    // optional tapi bagus untuk real hospital flow
    $table->enum('status', ['draft', 'completed'])->default('completed');

    $table->dateTime('waktu_pemeriksaan');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};
