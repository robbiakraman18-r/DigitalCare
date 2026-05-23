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
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id('id_pasien');
            // relasi ke users
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->date('birth_date');

            $table->string('phone_number', 20)->nullable();

            $table->enum('gender', ['Male', 'Female']);
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};