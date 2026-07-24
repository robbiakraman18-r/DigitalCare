<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #1e293b;
        }

        .header {
            border-bottom: 2px solid #0d9488;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 18px;
            margin: 0 0 4px 0;
            color: #0f172a;
        }

        .header p {
            font-size: 11px;
            color: #64748b;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #f1f5f9;
            text-align: left;
            padding: 8px;
            font-size: 10px;
            text-transform: uppercase;
            color: #64748b;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            padding: 8px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 11px;
        }

        .footer {
            margin-top: 20px;
            font-size: 9px;
            color: #94a3b8;
            text-align: right;
        }

        .info-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 10px 14px;
            margin-bottom: 12px;
        }

        .info-box .label {
            font-size: 9px;
            color: #64748b;
            text-transform: uppercase;
        }

        .info-box .value {
            font-size: 12px;
            font-weight: bold;
            color: #0f172a;
            margin-top: 2px;
        }

        .warning-box {
            margin-top: 14px;
            padding: 10px 14px;
            background-color: #fffbeb;
            border: 1px solid #fde68a;
        }

        .warning-box .warning-title {
            font-size: 10px;
            font-weight: bold;
            color: #b45309;
            margin: 0 0 4px 0;
            text-transform: uppercase;
        }

        .warning-box .warning-text {
            font-size: 10px;
            color: #92400e;
            margin: 0;
            line-height: 1.5;
        }
    </style>
</head>
<body>

    {{-- LETTERHEAD KLINIK --}}
    <div class="header">
        <h1>{{ $setting->clinic_name ?? 'DigitalCare Clinic' }}</h1>
        <p>
            @if($setting->address ?? false)
                {{ $setting->address }}
                @if($setting->city) , {{ $setting->city }} @endif
                &middot;
            @endif
            Dicetak pada {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB
        </p>
    </div>

    <p style="font-size: 14px; font-weight: bold; margin: 0 0 12px 0;">
        Rekam Medis Pasien
    </p>

    {{-- INFO PASIEN & KUNJUNGAN --}}
    <table style="margin-bottom: 14px;">
        <tr>
            <td style="width: 25%; border: none; padding: 3px 8px 3px 0; color: #64748b;">Nama Pasien</td>
            <td style="width: 25%; border: none; padding: 3px 0; font-weight: bold;">{{ $pasien->user->nama ?? '-' }}</td>
            <td style="width: 25%; border: none; padding: 3px 8px 3px 0; color: #64748b;">No. RM</td>
            <td style="width: 25%; border: none; padding: 3px 0; font-weight: bold;">
                RM{{ str_pad($pasien->id_pasien ?? 0, 4, '0', STR_PAD_LEFT) }}
            </td>
        </tr>
        <tr>
            <td style="border: none; padding: 3px 8px 3px 0; color: #64748b;">Dokter</td>
            <td style="border: none; padding: 3px 0; font-weight: bold;">{{ $rekamMedis->dokter->user->nama ?? '-' }}</td>
            <td style="border: none; padding: 3px 8px 3px 0; color: #64748b;">Ruangan</td>
            <td style="border: none; padding: 3px 0; font-weight: bold;">
                {{ $rekamMedis->appointment->jadwal->ruang ?? '-' }}
            </td>
        </tr>
        <tr>
            <td style="border: none; padding: 3px 8px 3px 0; color: #64748b;">Tanggal Kunjungan</td>
            <td style="border: none; padding: 3px 0; font-weight: bold;">
                {{ \Carbon\Carbon::parse($rekamMedis->waktu_pemeriksaan)->translatedFormat('d F Y') }}
            </td>
            <td style="border: none; padding: 3px 8px 3px 0; color: #64748b;">Jam Pemeriksaan</td>
            <td style="border: none; padding: 3px 0; font-weight: bold;">
                {{ \Carbon\Carbon::parse($rekamMedis->waktu_pemeriksaan)->format('H:i') }} WIB
            </td>
        </tr>
    </table>

    {{-- KELUHAN --}}
    <div class="info-box">
        <div class="label">Keluhan</div>
        <div class="value" style="font-weight: normal;">{{ $rekamMedis->keluhan ?? '-' }}</div>
    </div>

    {{-- DIAGNOSIS --}}
    <div class="info-box" style="background-color: #f0fdfa; border-color: #99f6e4;">
        <div class="label" style="color: #0d9488;">Diagnosis</div>
        <div class="value" style="color: #0f766e;">{{ $rekamMedis->diagnosa ?? '-' }}</div>
    </div>

    {{-- CATATAN DOKTER --}}
    @if($rekamMedis->catatan_dokter)
    <div class="info-box">
        <div class="label">Catatan Dokter</div>
        <div class="value" style="font-weight: normal;">{{ $rekamMedis->catatan_dokter }}</div>
    </div>
    @endif

    {{-- RESEP OBAT --}}
    <p style="font-size: 12px; font-weight: bold; color: #0f172a; margin: 18px 0 6px 0;">Resep Obat</p>

    @if($rekamMedis->detailResep && $rekamMedis->detailResep->count() > 0)

    <table>
        <thead>
            <tr>
                <th>Nama Obat</th>
                <th>Dosis</th>
                <th>Aturan Pakai</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rekamMedis->detailResep as $resep)
            <tr>
                <td>{{ $resep->nama_obat }}</td>
                <td>{{ $resep->dosis ?? '-' }}</td>
                <td>{{ $resep->aturan_pakai ?? '-' }}</td>
                <td>{{ $resep->jumlah }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- PERINGATAN KEPATUHAN OBAT --}}
    <div class="warning-box">
        <p class="warning-title">Penting Diperhatikan</p>
        <p class="warning-text">
            Konsumsi obat sesuai dosis dan aturan pakai yang tertera di atas. Jangan menghentikan atau mengubah
            dosis obat secara sepihak tanpa berkonsultasi dengan dokter. Jika muncul reaksi tidak biasa (alergi,
            efek samping, atau kondisi memburuk), segera hubungi dokter atau fasilitas kesehatan terdekat.
        </p>
    </div>

    @else
    <p style="font-size: 11px; color: #94a3b8;">Tidak ada resep obat pada kunjungan ini.</p>
    @endif

    <div class="footer">
        {{ $setting->clinic_name ?? 'DigitalCare Clinic' }} &middot; Dokumen Rahasia
    </div>

</body>
</html>