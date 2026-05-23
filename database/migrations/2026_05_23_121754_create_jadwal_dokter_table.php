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
        Schema::create('jadwal_dokter', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->unsignedBigInteger('id_dokter');
            $table->foreign('id_dokter')
                ->references('id_dokter')
                ->on('dokters');

            $table->date('tanggal');
            $table->string('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('ruang');

            // KUOTA
            $table->integer('kuota_harian');   // batas maksimal
            $table->integer('terisi')->default(0); // yang sudah booking

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
        Schema::dropIfExists('jadwal_dokter');
    }
};
