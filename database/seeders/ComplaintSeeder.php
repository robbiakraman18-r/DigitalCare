<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('complaints')->insert([
            [
                'user_name' => 'fahira',
                'message' => 'Aplikasi sering error saat login',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'selda',
                'message' => 'Dokter tidak muncul di jadwal',
                'status' => 'solved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'zahra',
                'message' => 'Sistem lambat saat buka halaman',
                'status' => 'rejected',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}