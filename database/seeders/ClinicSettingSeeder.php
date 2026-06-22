<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicSettingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('clinic_settings')->insertOrIgnore([
            'clinic_name'     => 'DigitalCare Clinic',
            'clinic_tagline'  => 'Kesehatan Anda, Prioritas Kami',
            'clinic_type'     => 'General Clinic',
            'clinic_email'    => 'info@digitalcare.id',
            'clinic_phone'    => '0778-123456',
            'clinic_whatsapp' => '08112345678',
            'address'         => 'Jl. Raya Batam No. 1',
            'city'            => 'Batam',
            'province'        => 'Kepulauan Riau',
            'postal_code'     => '29444',
            'open_days'       => 'Senin - Sabtu',
            'open_time'       => '08:00:00',
            'close_time'      => '17:00:00',
            'is_open_sunday'  => false,
            'is_open_24h'     => false,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);
    }
}