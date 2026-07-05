<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE notifikasis MODIFY tipe ENUM('jadwal','appointment','pasien','pemeriksaan','complaint') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE notifikasis MODIFY tipe ENUM('jadwal','appointment','pasien','pemeriksaan') NOT NULL");
    }
};