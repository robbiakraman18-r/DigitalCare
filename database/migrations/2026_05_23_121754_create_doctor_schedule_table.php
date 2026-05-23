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
        Schema::create('doctor_schedules', function (Blueprint $table) {
            $table->id('id_jadwal');
            // FOREIGN KEY
            $table->foreignId('id_dokter')
                  ->constrained('doctors', 'id_dokter')
                  ->onDelete('cascade');    
            $table->date('tanggal');
            $table->string('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('ruang');
            $table->integer('kuota_harian');
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
        Schema::dropIfExists('doctor_schedule');
    }
};
