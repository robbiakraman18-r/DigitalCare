<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dokter_id')->constrained('dokters', 'id_dokter')->onDelete('cascade');
            $table->enum('tipe', ['jadwal', 'appointment', 'pasien', 'pemeriksaan'])->index();
            $table->string('judul');
            $table->string('pesan')->nullable();
            $table->string('link')->nullable(); // route name atau url tujuan
            $table->boolean('is_read')->default(false)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};