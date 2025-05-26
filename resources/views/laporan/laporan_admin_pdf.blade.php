<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Admin</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            margin: 40px;
            color: #333;
        }

        h2 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 10px;
        }

        h3 {
            background-color: #f1f1f1;
            padding: 8px 12px;
            border-left: 5px solid #3498db;
            font-size: 16px;
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 25px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        th {
            background-color: #3498db;
            color: #fff;
            padding: 8px;
            font-weight: 600;
            border: 1px solid #ddd;
            text-align: left;
        }

        td {
            border: 1px solid #ddd;
            padding: 7px;
            vertical-align: top;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 11px;
            color: #777;
        }
    </style>
</head>
<body>
    <h2>Laporan Lengkap Data Admin</h2>

    <h3>Data Users</h3>
    <table>
        <thead>
            <tr><th>Nama</th><th>Email</th><th>Jabatan</th></tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->jabatan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Data Pelanggan</h3>
    <table>
        <thead>
            <tr><th>Nama</th><th>Email</th><th>No Telp</th><th>Alamat</th></tr>
        </thead>
        <tbody>
            @foreach ($pelanggan as $item)
            <tr>
                <td>{{ $item->nama_pelanggan }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->no_telp }}</td>
                <td>{{ $item->alamat1 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Data Distributor</h3>
    <table>
        <thead>
            <tr><th>Nama</th><th>Telepon</th><th>Alamat</th></tr>
        </thead>
        <tbody>
            @foreach ($distributor as $item)
            <tr>
                <td>{{ $item->nama_distributor }}</td>
                <td>{{ $item->telepon }}</td>
                <td>{{ $item->alamat }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Metode Pembayaran</h3>
    <table>
        <thead>
            <tr><th>Metode</th><th>Tempat</th><th>No Rekening</th></tr>
        </thead>
        <tbody>
            @foreach ($metodeBayar as $item)
            <tr>
                <td>{{ $item->metode_pembayaran }}</td>
                <td>{{ $item->tempat_bayar }}</td>
                <td>{{ $item->no_rekening ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Jenis Pengiriman</h3>
    <table>
        <thead>
            <tr><th>Jenis Kirim</th><th>Ekspedisi</th><th>Ongkos Kirim</th></tr>
        </thead>
        <tbody>
            @foreach ($jenisPengiriman as $item)
            <tr>
                <td>{{ $item->jenis_kirim }}</td>
                <td>{{ $item->nama_ekspedisi }}</td>
                <td>Rp {{ number_format($item->ongkos_kirim, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada {{ now()->format('d-m-Y H:i') }} &mdash; Laporan Sistem
    </div>
</body>
</html>
