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

    // FK ke janji temu (appointment)
    $table->unsignedBigInteger('id_janji');

$table->foreign('id_janji')
    ->references('id_janji')
    ->on('appointments')
    ->onDelete('cascade');

    // FK ke dokter
    $table->foreignId('id_dokter')
        ->constrained('dokters', 'id_dokter')
        ->onDelete('cascade');

    $table->text('diagnosa');
    $table->text('keluhan');
    $table->text('catatan_dokter')->nullable();

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
