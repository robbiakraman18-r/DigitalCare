<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
    $table->id('id_jadwal');

    // RELASI KE DOKTER
    $table->foreignId('id_dokter')
        ->constrained('dokters', 'id_dokter')
        ->onDelete('cascade');

    $table->string('hari');
    $table->date('tanggal');

    $table->time('jam_mulai');
    $table->time('jam_selesai');

    $table->integer('ruang_kuota_harian');

    $table->enum('status_jadwal', ['active', 'inactive'])
        ->default('active');

    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};