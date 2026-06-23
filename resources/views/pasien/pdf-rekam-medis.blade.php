<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekam Medis</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #1e293b;
            background: #fff;
            padding: 36px 40px;
        }

        /* ── HEADER ── */
        .header {
            border-bottom: 3px solid #14b8a6;
            padding-bottom: 16px;
            margin-bottom: 20px;
        }

        .header-inner {
            display: table;
            width: 100%;
        }

        .header-left {
            display: table-cell;
            vertical-align: middle;
            width: 70%;
        }

        .header-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 30%;
        }

        .clinic-name {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
        }

        .clinic-name span { color: #14b8a6; }

        .clinic-sub {
            font-size: 10px;
            color: #64748b;
            margin-top: 2px;
        }

        .doc-title {
            font-size: 13px;
            font-weight: 700;
            color: #14b8a6;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .doc-number {
            font-size: 10px;
            color: #94a3b8;
            margin-top: 3px;
        }

        /* ── BADGE STATUS ── */
        .badge {
            display: inline-block;
            background: #d1fae5;
            color: #065f46;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
            margin-bottom: 16px;
        }

        /* ── SECTION TITLE ── */
        .section-title {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #14b8a6;
            padding-bottom: 5px;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 10px;
            margin-top: 18px;
        }

        /* ── INFO GRID ── */
        .info-table {
            display: table;
            width: 100%;
        }

        .info-row { display: table-row; }

        .info-label {
            display: table-cell;
            width: 38%;
            padding: 4px 0;
            color: #64748b;
        }

        .info-colon {
            display: table-cell;
            width: 4%;
            padding: 4px 0;
            color: #64748b;
        }

        .info-value {
            display: table-cell;
            width: 58%;
            padding: 4px 0;
            font-weight: 600;
            color: #0f172a;
        }

        /* ── TWO COLUMN ── */
        .two-col { display: table; width: 100%; }
        .col-l { display: table-cell; width: 50%; vertical-align: top; padding-right: 12px; }
        .col-r { display: table-cell; width: 50%; vertical-align: top; padding-left: 12px; }

        /* ── DIAGNOSIS BOX ── */
        .diagnosis-box {
            background: #f0fdfa;
            border: 1px solid #99f6e4;
            border-left: 4px solid #14b8a6;
            border-radius: 6px;
            padding: 12px 14px;
            margin-top: 10px;
        }

        .diagnosis-label {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #14b8a6;
            font-weight: 700;
        }

        .diagnosis-value {
            font-size: 14px;
            font-weight: 700;
            color: #0f766e;
            margin-top: 4px;
        }

        /* ── NOTES BOX ── */
        .notes-box {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 6px;
            padding: 12px 14px;
            color: #78350f;
            line-height: 1.7;
            margin-top: 10px;
        }

        /* ── RESEP TABLE ── */
        .resep-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .resep-table thead tr {
            background: #14b8a6;
        }

        .resep-table th {
            padding: 7px 10px;
            text-align: left;
            font-size: 10px;
            font-weight: 700;
            color: #fff;
        }

        .resep-table td {
            padding: 7px 10px;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
        }

        .resep-table tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        /* ── FOOTER ── */
        .footer {
            margin-top: 36px;
            border-top: 1px solid #e2e8f0;
            padding-top: 16px;
        }

        .footer-inner { display: table; width: 100%; }

        .footer-left {
            display: table-cell;
            width: 60%;
            vertical-align: bottom;
        }

        .footer-right {
            display: table-cell;
            width: 40%;
            text-align: center;
            vertical-align: top;
        }

        .footer-note {
            font-size: 9px;
            color: #94a3b8;
            line-height: 1.6;
        }

        .ttd-label {
            font-size: 10px;
            color: #475569;
            margin-bottom: 50px;
        }

        .ttd-name {
            font-size: 11px;
            font-weight: 700;
            color: #0f172a;
            border-top: 1px solid #cbd5e1;
            padding-top: 6px;
            margin-top: 4px;
        }

        .ttd-role {
            font-size: 9px;
            color: #64748b;
        }

        /* ── WATERMARK CONFIDENTIAL ── */
        .confidential {
            font-size: 9px;
            font-weight: 700;
            color: #ef4444;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 4px;
        }

        /* ── NO RESEP ── */
        .no-resep {
            text-align: center;
            color: #94a3b8;
            padding: 14px;
            font-style: italic;
        }
    </style>
</head>
<body>

    {{-- ══ HEADER ══ --}}
    <div class="header">
        <div class="header-inner">
            <div class="header-left">
                <div class="clinic-name">
                    {{ $setting->clinic_name ?? 'Digital' }}<span>Care</span>
                </div>
                <div class="clinic-sub">
                    {{ $setting->clinic_address ?? '' }}
                    @if($setting->clinic_phone) &nbsp;|&nbsp; Telp: {{ $setting->clinic_phone }} @endif
                    @if($setting->clinic_email) &nbsp;|&nbsp; {{ $setting->clinic_email }} @endif
                </div>
            </div>
            <div class="header-right">
                <div class="doc-title">Rekam Medis</div>
                <div class="doc-number">
                    No. RM-{{ str_pad($rekamMedis->id_rekam_medis, 5, '0', STR_PAD_LEFT) }}
                </div>
            </div>
        </div>
    </div>

    {{-- BADGE --}}
    <span class="badge">&#10003; Selesai</span>

    {{-- ══ DATA PASIEN & KUNJUNGAN ══ --}}
    <div class="section-title">Informasi Pasien & Kunjungan</div>

    <div class="two-col">
        <div class="col-l">
            <div class="info-table">
                <div class="info-row">
                    <div class="info-label">Nama Pasien</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $pasien->user->nama ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Jenis Kelamin</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $pasien->jenis_kelamin ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal Lahir</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">
                        {{ $pasien->tanggal_lahir
                            ? \Carbon\Carbon::parse($pasien->tanggal_lahir)->translatedFormat('d F Y')
                            : '-' }}
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">No. HP</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $pasien->no_hp ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Alamat</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $pasien->alamat ?? '-' }}</div>
                </div>
            </div>
        </div>

        <div class="col-r">
            <div class="info-table">
                <div class="info-row">
                    <div class="info-label">Tanggal Kunjungan</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">
                        {{ \Carbon\Carbon::parse($rekamMedis->waktu_pemeriksaan)->translatedFormat('d F Y') }}
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Jam Pemeriksaan</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">
                        {{ \Carbon\Carbon::parse($rekamMedis->waktu_pemeriksaan)->format('H:i') }} WIB
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Dokter</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $rekamMedis->dokter->user->nama ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Ruangan</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">
                        {{ $rekamMedis->appointment->jadwaldokter->ruang ?? '-' }}
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">No. Antrian</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">
                        {{ $rekamMedis->appointment->nomor_antrian ?? '-' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ KELUHAN ══ --}}
    <div class="section-title">Keluhan</div>
    <div class="info-table">
        <div class="info-row">
            <div class="info-label">Keluhan Utama</div>
            <div class="info-colon">:</div>
            <div class="info-value">{{ $rekamMedis->appointment->keluhan_utama ?? '-' }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Keluhan Pemeriksaan</div>
            <div class="info-colon">:</div>
            <div class="info-value">{{ $rekamMedis->keluhan ?? '-' }}</div>
        </div>
    </div>

    {{-- ══ DIAGNOSIS ══ --}}
    <div class="section-title">Diagnosis</div>
    <div class="diagnosis-box">
        <div class="diagnosis-label">Hasil Diagnosis</div>
        <div class="diagnosis-value">{{ $rekamMedis->diagnosa ?? '-' }}</div>
    </div>

    {{-- ══ CATATAN DOKTER ══ --}}
    <div class="section-title">Catatan Dokter</div>
    <div class="notes-box">
        {{ $rekamMedis->catatan_dokter ?? 'Tidak ada catatan dari dokter.' }}
    </div>

    {{-- ══ RESEP ══ --}}
    <div class="section-title">Resep Obat</div>

    @if($rekamMedis->detailResep && $rekamMedis->detailResep->count() > 0)
    <table class="resep-table">
        <thead>
            <tr>
                <th style="width:5%">No</th>
                <th style="width:30%">Nama Obat</th>
                <th style="width:20%">Dosis</th>
                <th style="width:15%">Jumlah</th>
                <th style="width:30%">Aturan Pakai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rekamMedis->detailResep as $i => $resep)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $resep->nama_obat }}</td>
                <td>{{ $resep->dosis ?? '-' }}</td>
                <td>{{ $resep->jumlah ?? '-' }} pcs</td>
                <td>{{ $resep->aturan_pakai ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="no-resep">Tidak ada resep obat yang diberikan.</div>
    @endif

    {{-- ══ FOOTER ══ --}}
    <div class="footer">
        <div class="footer-inner">
            <div class="footer-left">
                <div class="confidential">&#9888; Dokumen Rahasia</div>
                <div class="footer-note">
                    Dokumen ini adalah rekam medis resmi yang bersifat rahasia.<br>
                    Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB<br>
                    {{ $setting->clinic_name ?? 'DigitalCare' }} &mdash; {{ $setting->clinic_address ?? '' }}
                </div>
            </div>
            <div class="footer-right">
                <div class="ttd-label">Dokter Pemeriksa,</div>
                <div class="ttd-name">{{ $rekamMedis->dokter->user->nama ?? '-' }}</div>
                <div class="ttd-role">Dokter</div>
            </div>
        </div>
    </div>

</body>
</html>