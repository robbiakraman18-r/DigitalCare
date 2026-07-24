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

        .stat-row {
            width: 100%;
            margin-bottom: 16px;
        }

        .stat-box {
            display: inline-block;
            width: 22%;
            padding: 10px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            margin-right: 1%;
        }

        .stat-box .label {
            font-size: 9px;
            color: #64748b;
            text-transform: uppercase;
        }

        .stat-box .value {
            font-size: 18px;
            font-weight: bold;
            color: #0f172a;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>@yield('report_title')</h1>
        <p>Dibuat pada {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }}</p>
    </div>

    @yield('report_body')

    <div class="footer">
        DigitalCare Clinic &middot; Dokumen Rahasia
    </div>

</body>
</html>