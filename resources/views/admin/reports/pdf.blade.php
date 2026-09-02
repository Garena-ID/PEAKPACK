<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PeakPack - Laporan Rekapitulasi Penyewaan</title>
    <link rel="icon" type="image/png" href="{{ asset('images/peakpack/favicon.svg') }}">
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #1e293b;
            margin: 0;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-b: 2px solid #064e3b;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .logo {
            font-size: 24px;
            font-weight: 900;
            color: #064e3b;
        }
        .logo span {
            color: #f59e0b;
        }
        .title {
            text-align: right;
        }
        .title h1 {
            margin: 0;
            font-size: 18px;
            color: #064e3b;
            text-transform: uppercase;
        }
        .title p {
            margin: 3px 0 0 0;
            font-size: 11px;
            color: #64748b;
        }
        .meta-table {
            width: 100%;
            margin-bottom: 20px;
            font-size: 11px;
        }
        .meta-table td {
            padding: 4px 0;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table.data-table th {
            background-color: #064e3b;
            color: #ffffff;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
            padding: 8px 10px;
            text-align: left;
            border: 1px solid #064e3b;
        }
        table.data-table td {
            padding: 8px 10px;
            border: 1px solid #cbd5e1;
            font-size: 11px;
        }
        table.data-table tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            background-color: #e2e8f0;
            color: #1e293b;
        }
        .summary-box {
            float: right;
            width: 300px;
            border: 1px solid #064e3b;
            border-radius: 6px;
            padding: 12px;
            background-color: #f0fdf4;
            margin-top: 10px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 4px 0;
            font-size: 12px;
        }
        .summary-row.total {
            border-t: 2px solid #064e3b;
            font-weight: bold;
            font-size: 14px;
            color: #064e3b;
            margin-top: 6px;
            padding-top: 6px;
        }
        .footer {
            clear: both;
            margin-top: 40px;
            padding-top: 15px;
            border-t: 1px solid #cbd5e1;
            text-align: center;
            font-size: 10px;
            color: #94a3b8;
        }
        @media print {
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        body {
            padding: 0;
        }

        .no-print {
            display: none !important;
        }
    }
    </style>
</head>
<body onload="window.print()">

    <div class="no-print" style="margin-bottom: 20px; text-align: right;">
        <button onclick="window.print()" style="background-color: #064e3b; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; font-weight: bold;">
             Cetak / Simpan PDF
        </button>
    </div>

    <div class="header">
        <div class="logo">
            ▲ PeakPack
        </div>
        <div class="title">
            <h1>Laporan Transaksi Penyewaan</h1>
            <p>PeakPack Outdoor Gear Rental Platform</p>
        </div>
    </div>

    <table class="meta-table">
        <tr>
            <td width="15%"><strong>Periode Laporan</strong></td>
            <td width="35%">: {{ ($startDate ?: 'Awal') . ' s/d ' . ($endDate ?: 'Akhir') }}</td>
            <td width="15%"><strong>Tanggal Cetak</strong></td>
            <td width="35%">: {{ date('d M Y H:i:s') }}</td>
        </tr>
        <tr>
            <td><strong>Filter Status</strong></td>
            <td>: {{ $status ?: 'Semua Status' }}</td>
            <td><strong>Total Record</strong></td>
            <td>: {{ $rentals->count() }} transaksi</td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="14%">Kode Rental</th>
                <th width="18%">Customer</th>
                <th width="16%">Tgl Sewa – Kembali</th>
                <th width="26%">Detail Items</th>
                <th width="10%">Status</th>
                <th width="12%" class="text-right">Total (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rentals as $index => $r)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td><strong>{{ $r->rental_code }}</strong></td>
                    <td>
                        {{ $r->user->name ?? '-' }}<br>
                        <small style="color: #64748b;">{{ $r->user->email ?? '' }}</small>
                    </td>
                    <td>
                        {{ $r->rental_date ? $r->rental_date->format('d/m/Y') : '-' }}<br>
                        <small style="color: #64748b;">s/d {{ $r->due_date ? $r->due_date->format('d/m/Y') : '-' }}</small>
                    </td>
                    <td>
                        @foreach($r->rentalItems as $item)
                            • {{ $item->gear->name ?? 'Gear' }} ({{ $item->qty }}x)<br>
                        @endforeach
                    </td>
                    <td class="text-center">
                        <span class="badge">{{ $r->status }}</span>
                    </td>
                    <td class="text-right">
                        {{ number_format($r->total_price, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center" style="padding: 20px;">
                        Tidak ada data transaksi penyewaan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary-box">
        <div class="summary-row">
            <span>Total Transaksi:</span>
            <span>{{ $rentals->count() }}</span>
        </div>
        <div class="summary-row">
            <span>Status Completed:</span>
            <span>{{ $rentals->where('status', 'Completed')->count() }}</span>
        </div>
        <div class="summary-row total">
            <span>Total Revenue:</span>
            <span>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="footer">
        Laporan ini dicetak secara otomatis dari Sistem PeakPack Platform pada {{ date('d M Y') }}

</body>
</html>
