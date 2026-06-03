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
        Schema::create('jadwal_dokters', function (Blueprint $table) {
    $table->id('id_jadwal');

    // RELASI DOKTER
    $table->foreignId('id_dokter')
        ->constrained('dokters', 'id_dokter')
        ->onDelete('cascade');

    $table->date('tanggal');
    $table->string('hari');

    $table->time('jam_mulai');
    $table->time('jam_selesai');

    $table->string('ruang');

    // KUOTA
    $table->integer('kuota_harian');
    $table->integer('terisi')->default(0);
    
    $table->integer('current_antrian')->default(0);

    $table->enum('status_jadwal', [
        'Available',
        'Full',
        'Closed'
    ])->default('Available');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_dokters');
    }
    
};
