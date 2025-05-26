<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan Apotek Bio Pharm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #333;
        }
        h2 {
            text-align: center;
            color: #1a1a1a;
            margin-bottom: 5px;
        }
        .total {
            text-align: right;
            font-weight: bold;
            margin-bottom: 15px;
            font-size: 14px;
            color: #1a1a1a;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color: #007BFF;
            color: white;
            padding: 8px;
            text-align: left;
            border: 1px solid #ccc;
        }
        td {
            padding: 8px;
            border: 1px solid #ccc;
            vertical-align: top;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 11px;
            color: #777;
        }
    </style>
</head>
<body>
    <h2>Laporan Penjualan Apotek Bio Pharm</h2>

    @php
        $totalBayar = $data->sum('total_bayar');
    @endphp

    <div class="total">
        Total Penjualan: <strong>Rp {{ number_format($totalBayar, 0, ',', '.') }}</strong>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Jenis Kirim</th>
                <th>Total Bayar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ \Carbon\Carbon::parse($item->tgl_penjualan)->format('d-m-Y') }}</td>
                <td>{{ $item->pelanggan->nama_pelanggan ?? '-' }}</td>
                <td>{{ $item->jenisPengiriman->jenis_kirim ?? '-' }}</td>
                <td>Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                <td>{{ $item->status_order }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
    </div>
</body>
</html>
