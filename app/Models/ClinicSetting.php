<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicSetting extends Model
{
    public function index()
    {
        $setting = ClinicSetting::instance(); // pakai method singleton yang sudah dibuat

        return view('dokter.clinic', compact('setting'));
    }
    protected $table = 'clinic_settings';

    protected $fillable = [
        'clinic_name',
        'clinic_tagline',
        'clinic_type',
        'clinic_email',
        'clinic_phone',
        'clinic_whatsapp',
        'clinic_website',
        'clinic_logo',
        'address',
        'city',
        'province',
        'postal_code',
        'google_maps_url',
        'open_days',
        'open_time',
        'close_time',
        'is_open_sunday',
        'sunday_hours',
        'is_open_24h',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'license_number',
        'tax_number',
        'license_expiry',
    ];

    protected $casts = [
        'is_open_sunday' => 'boolean',
        'is_open_24h'    => 'boolean',
        'license_expiry' => 'date',
    ];

    /**
     * Selalu ambil baris pertama (singleton pattern).
     * Kalau belum ada, buat otomatis dengan nilai default.
     */
    public static function instance(): self
    {
        return self::firstOrCreate(
            ['id' => 1],
            ['clinic_name' => 'DigitalCare Clinic']
        );
    }
}