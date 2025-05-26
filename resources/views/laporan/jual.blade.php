<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan Obat</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #d62828; color: white; }
        h2 { text-align: center; color: #003049; }
        .subtotal-total {
            margin-top: 20px;
            font-weight: bold;
            font-size: 14px;
            color: #003049;
        }
    </style>
</head>
<body>
    <h2>Laporan Penjualan Obat Di Kasir Offline</h2>

    <div class="subtotal-total">
        Total Pendapatan Kasir: Rp {{ number_format($totalSubtotal, 0, ',', '.') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Obat</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jual as $i => $row)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $row->obat->nama_obat ?? '-' }}</td>
                <td>{{ $row->jumlah }}</td>
                <td>Rp {{ number_format($row->harga, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($row->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
