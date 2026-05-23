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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id('id_dokter');
            // FOREIGN KEY KE USERS
            $table->foreignId('user_id')
                  ->constrained('users');
                  
            $table->string('nama');
            $table->string('no_sip')->unique();
            $table->string('foto_profil')->nullable();
            $table->enum('status_ketersediaan', [
                'Available',
                'Unavailable'
            ])->default('Available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor');
    }
};
