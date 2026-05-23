<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id('id_pasien');
            
            // Relasi asing ke tabel users
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Kolom Nomor Rekam Medis Baru
            $table->string('no_rm', 15)->unique();

            // Semua kolom biodata diatur ->nullable() agar register awal tidak crash
            $table->date('birth_date')->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->string('address')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};