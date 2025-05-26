<!DOCTYPE html>
<html>
<head>
    <title>Laporan Detail Pembelian Apotek Bio Pharm</title>
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
            background-color: #28a745;
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
    <h2>Laporan Pembelian Apotek Bio Pharm</h2>

    @php
        $totalPembelian = $data->sum('subtotal');
    @endphp

    <div class="total">
        Total Pembelian: <strong>Rp {{ number_format($totalPembelian, 0, ',', '.') }}</strong>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Obat</th>
                <th>Jumlah</th>
                <th>Harga Beli</th>
                <th>Subtotal</th>
                <th>Tanggal Pembelian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $item->obat->nama_obat ?? '-' }}</td>
                <td>{{ $item->jumlah_beli }}</td>
                <td>Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->pembelian->created_at)->format('d-m-Y') ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
    </div>
</body>
</html>
