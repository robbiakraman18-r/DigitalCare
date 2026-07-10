<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekam Medis - {{ $rekamMedis->id_rekam_medis }}</title>
    <style>
        @page { margin: 30px 40px; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #334155;
        }
        .header {
            background: #0d9488;
            color: #ffffff;
            padding: 18px 22px;
            border-radius: 10px;
            margin-bottom: 18px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            letter-spacing: 0.5px;
        }
        .header p {
            margin: 4px 0 0;
            font-size: 11px;
            color: #ccfbf1;
        }
        .meta-table {
            width: 100%;
            margin-top: 10px;
        }
        .meta-table td {
            font-size: 10px;
            color: #f0fdfa;
            padding-top: 4px;
        }
        .section {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 14px 16px;
            margin-bottom: 14px;
        }
        .section-title {
            font-size: 13px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 6px;
        }
        table.info-grid {
            width: 100%;
            border-collapse: collapse;
        }
        table.info-grid td {
            width: 50%;
            padding: 6px 8px;
            vertical-align: top;
        }
        .label {
            font-size: 9px;
            text-transform: uppercase;
            color: #94a3b8;
            letter-spacing: 0.5px;
        }
        .value {
            font-size: 11.5px;
            font-weight: bold;
            color: #334155;
            margin-top: 2px;
        }
        .diagnosis-box {
            background: #f0fdfa;
            border: 1px solid #99f6e4;
            border-radius: 8px;
            padding: 12px 14px;
            margin-top: 6px;
        }
        .diagnosis-box .label { color: #0d9488; }
        .diagnosis-box .value { color: #0f766e; font-size: 13px; }

        table.resep-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }
        table.resep-table th {
            background: #ecfdf5;
            color: #047857;
            font-size: 9.5px;
            text-transform: uppercase;
            text-align: left;
            padding: 6px 8px;
            border-bottom: 1px solid #d1fae5;
        }
        table.resep-table td {
            font-size: 10.5px;
            padding: 6px 8px;
            border-bottom: 1px solid #f1f5f9;
        }
        .notes {
            font-size: 11px;
            line-height: 1.6;
            color: #475569;
        }
        .footer {
            margin-top: 24px;
            font-size: 9px;
            color: #94a3b8;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>REKAM MEDIS</h1>
        <p>Hasil Konsultasi Pasien</p>
        <table class="meta-table">
            <tr>
                <td><strong>No. Rekam Medis:</strong> DCM26-{{ $rekamMedis->appointment->id_janji ?? $rekamMedis->id_rekam_medis }}</td>
                <td><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB</td>
            </tr>
        </table>
    </div>

    {{-- PATIENT & VISIT INFO --}}
    <div class="section">
        <div class="section-title">Informasi Kunjungan</div>
        <table class="info-grid">
            <tr>
                <td>
                    <div class="label">Nama Pasien</div>
                    <div class="value">{{ $rekamMedis->appointment->pasien->user->nama ?? '-' }}</div>
                </td>
                <td>
                    <div class="label">Dokter</div>
                    <div class="value">{{ $rekamMedis->dokter->user->nama ?? '-' }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="label">Tanggal Pemeriksaan</div>
                    <div class="value">{{ \Carbon\Carbon::parse($rekamMedis->waktu_pemeriksaan)->translatedFormat('l, d F Y') }}</div>
                </td>
                <td>
                    <div class="label">Jam Pemeriksaan</div>
                    <div class="value">{{ \Carbon\Carbon::parse($rekamMedis->waktu_pemeriksaan)->format('H:i') }} WIB</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="label">Ruangan</div>
                    <div class="value">{{ $rekamMedis->appointment->jadwaldokter->ruang ?? '-' }}</div>
                </td>
                <td>
                    <div class="label">No. SIP Dokter</div>
                    <div class="value">{{ $rekamMedis->dokter->no_sip ?? '-' }}</div>
                </td>
            </tr>
        </table>
    </div>

    {{-- CLINICAL INFO --}}
    {{-- FIX: dulu ada 2 field ("Keluhan Utama" dari appointment->keluhan_utama dan
         "Keluhan Saat Pemeriksaan" dari rekamMedis->keluhan) yang isinya sering
         double karena textarea Anamnesis di form dokter di-prefill dari keluhan_utama.
         Sekarang cuma tampilkan rekamMedis->keluhan, data final yang benar-benar
         diinput/dikonfirmasi dokter, biar konsisten dengan halaman pasien. --}}
    <div class="section">
        <div class="section-title">Informasi Klinis</div>
        <table class="info-grid">
            <tr>
                <td colspan="2">
                    <div class="label">Keluhan</div>
                    <div class="value">{{ $rekamMedis->keluhan ?? '-' }}</div>
                </td>
            </tr>
        </table>

        <div class="diagnosis-box">
            <div class="label">Diagnosis</div>
            <div class="value">{{ $rekamMedis->diagnosa ?? '-' }}</div>
        </div>
    </div>

    {{-- PRESCRIPTION --}}
    <div class="section">
        <div class="section-title">Resep Obat</div>
        @if($rekamMedis->detailResep && $rekamMedis->detailResep->count() > 0)
        <table class="resep-table">
            <thead>
                <tr>
                    <th>Nama Obat</th>
                    <th>Dosis</th>
                    <th>Jumlah</th>
                    <th>Aturan Pakai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rekamMedis->detailResep as $resep)
                <tr>
                    <td>{{ $resep->nama_obat }}</td>
                    <td>{{ $resep->dosis ?? '-' }}</td>
                    <td>{{ $resep->jumlah }} pcs</td>
                    <td>{{ $resep->aturan_pakai ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="notes">Tidak ada resep obat.</p>
        @endif
    </div>

    {{-- NOTES --}}
    <div class="section">
        <div class="section-title">Catatan Dokter</div>
        <p class="notes">{{ $rekamMedis->catatan_dokter ?? 'Tidak ada catatan dari dokter.' }}</p>
    </div>

    <div class="footer">
        Dokumen ini dicetak otomatis dari sistem dan sah tanpa tanda tangan basah.
    </div>

</body>
</html>