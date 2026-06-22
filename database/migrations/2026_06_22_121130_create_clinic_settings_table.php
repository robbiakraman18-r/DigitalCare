<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clinic_settings', function (Blueprint $table) {
            $table->id();

            // INFO UMUM
            $table->string('clinic_name')->default('DigitalCare Clinic');
            $table->string('clinic_tagline')->nullable();
            $table->string('clinic_type')->default('General Clinic');
            $table->string('clinic_email')->nullable();
            $table->string('clinic_phone')->nullable();
            $table->string('clinic_whatsapp')->nullable();
            $table->string('clinic_website')->nullable();
            $table->string('clinic_logo')->nullable();

            // ALAMAT
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('google_maps_url')->nullable();

            // JAM OPERASIONAL
            $table->string('open_days')->default('Senin - Sabtu');
            $table->time('open_time')->default('08:00:00');
            $table->time('close_time')->default('17:00:00');
            $table->boolean('is_open_sunday')->default(false);
            $table->string('sunday_hours')->nullable();
            $table->boolean('is_open_24h')->default(false);

            // SOSIAL MEDIA
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();

            // INFO LEGAL
            $table->string('license_number')->nullable(); // No. izin klinik
            $table->string('tax_number')->nullable();     // NPWP
            $table->date('license_expiry')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clinic_settings');
    }
};