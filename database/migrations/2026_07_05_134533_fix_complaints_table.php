<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Perbaikan tabel `complaints` supaya sesuai alur:
 * pending -> in_progress -> resolved -> closed
 *
 * Perubahan:
 * - tambah kolom `user_id` (relasi ke tabel users, pengganti user_name bebas)
 * - tambah kolom `response` (jawaban admin/dokter atas komplain)
 * - kolom `status` diubah jadi ENUM 4 tahap (sebelumnya varchar bebas)
 * - tambah kolom `confirmed_at` (diisi saat pasien/dokter konfirmasi puas -> closed)
 * - hapus kolom `user_name` (sudah digantikan relasi user_id)
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id')->nullable();
            $table->text('response')->nullable()->after('message');
        });

        // Ubah status jadi ENUM 4 tahap. Pakai raw statement karena
        // Schema::table()->enum() tidak bisa MODIFY tanpa doctrine/dbal.
        DB::statement("ALTER TABLE complaints MODIFY status ENUM('pending','in_progress','resolved','closed') NOT NULL DEFAULT 'pending'");

        Schema::table('complaints', function (Blueprint $table) {
            $table->timestamp('confirmed_at')->nullable()->after('response');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        if (Schema::hasColumn('complaints', 'user_name')) {
            Schema::table('complaints', function (Blueprint $table) {
                $table->dropColumn('user_name');
            });
        }
    }

    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'response', 'confirmed_at']);
            $table->string('user_name')->nullable();
        });

        DB::statement("ALTER TABLE complaints MODIFY status VARCHAR(255) NOT NULL DEFAULT 'pending'");
    }
};