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
        Schema::create('admin', function (Blueprint $table) {
            $table->id('id_admin');
            // FOREIGN KEY KE USERS
            $table->foreignId('user_id')
                ->constrained('users');
                
            $table->string('nama', 60);
            $table->string('email')->unique();
            $table->enum('role', ['admin', 'dokter', 'pasien']);
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
