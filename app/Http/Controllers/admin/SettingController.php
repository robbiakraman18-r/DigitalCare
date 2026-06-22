<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClinicSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $setting = ClinicSetting::instance();

        return view('admin.settings', compact('setting'));
    }

    public function updateGeneral(Request $request)
    {
        $request->validate([
            'clinic_name'    => 'required|string|max:100',
            'clinic_tagline' => 'nullable|string|max:150',
            'clinic_type'    => 'nullable|string|max:100',
            'clinic_email'   => 'nullable|email|max:100',
            'clinic_phone'   => 'nullable|string|max:20',
            'clinic_whatsapp'=> 'nullable|string|max:20',
            'clinic_website' => 'nullable|url|max:200',
            'clinic_logo'    => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $setting = ClinicSetting::instance();

        $data = $request->only([
            'clinic_name', 'clinic_tagline', 'clinic_type',
            'clinic_email', 'clinic_phone', 'clinic_whatsapp', 'clinic_website',
        ]);

        if ($request->hasFile('clinic_logo')) {
            if ($setting->clinic_logo) {
                Storage::disk('public')->delete($setting->clinic_logo);
            }
            $data['clinic_logo'] = $request->file('clinic_logo')
                ->store('clinic', 'public');
        }

        $setting->update($data);

        return back()->with('success', 'Informasi umum klinik berhasil diperbarui.');
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'address'         => 'nullable|string|max:300',
            'city'            => 'nullable|string|max:100',
            'province'        => 'nullable|string|max:100',
            'postal_code'     => 'nullable|string|max:10',
            'google_maps_url' => 'nullable|url|max:500',
        ]);

        ClinicSetting::instance()->update($request->only([
            'address', 'city', 'province', 'postal_code', 'google_maps_url',
        ]));

        return back()->with('success', 'Alamat klinik berhasil diperbarui.');
    }

    public function updateHours(Request $request)
    {
        $request->validate([
            'open_days'    => 'nullable|string|max:100',
            'open_time'    => 'nullable|date_format:H:i',
            'close_time'   => 'nullable|date_format:H:i',
            'sunday_hours' => 'nullable|string|max:50',
        ]);

        ClinicSetting::instance()->update([
            'open_days'      => $request->open_days,
            'open_time'      => $request->open_time,
            'close_time'     => $request->close_time,
            'is_open_sunday' => $request->boolean('is_open_sunday'),
            'sunday_hours'   => $request->sunday_hours,
            'is_open_24h'    => $request->boolean('is_open_24h'),
        ]);

        return back()->with('success', 'Jam operasional berhasil diperbarui.');
    }

    public function updateSocial(Request $request)
    {
        $request->validate([
            'facebook'  => 'nullable|url|max:200',
            'instagram' => 'nullable|url|max:200',
            'twitter'   => 'nullable|url|max:200',
            'youtube'   => 'nullable|url|max:200',
        ]);

        ClinicSetting::instance()->update($request->only([
            'facebook', 'instagram', 'twitter', 'youtube',
        ]));

        return back()->with('success', 'Sosial media berhasil diperbarui.');
    }

    public function updateLegal(Request $request)
    {
        $request->validate([
            'license_number' => 'nullable|string|max:100',
            'tax_number'     => 'nullable|string|max:30',
            'license_expiry' => 'nullable|date',
        ]);

        ClinicSetting::instance()->update($request->only([
            'license_number', 'tax_number', 'license_expiry',
        ]));

        return back()->with('success', 'Informasi legal berhasil diperbarui.');
    }
}