<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Buku</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            padding: 0;
        }
        .kop-surat {
            border-bottom: 3px solid black;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-align: center;
            position: relative;
        }
        .kop-surat img {
            max-width: 120px;
            position: absolute;
            left: 10px;
            top: 10px;
        }
        .kop-surat h3 {
            margin: 5px 0;
        }
        .kop-surat p {
            margin: 3px 0;
            font-size: 12px;
        }
        .kop-surat a {
            color: blue;
            text-decoration: underline;
        }
        h5 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }
        th {
            background-color: #f3f3f3;
        }
        .bg-success {
            background-color: #d4edda;
        }
        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="kop-surat">
        <img src="{{ public_path('img/Logosmkypkk.png') }}" alt="Logo SMK YPKK">
        <h3>SMK 1 YPKK SLEMAN</h3>
        <p>TERAKREDITASI A</p>
        <p>Alamat: Jl. Sidoarum-Gamping No.2, Mejing Wetan, Ambarketawang,</p>
        <p>Kec. Gamping, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55294</p>
        <p>Telp. (0274) 798806</p>
        <p>
            Website: <a href="http://smkypkk1gamping.sch">http://smkypkk1gamping.sch</a> | 
            Email: <a href="mailto:smkypkk1_gmp@yahoo.co.id">smkypkk1_gmp@yahoo.co.id</a>
        </p>
    </div>

    <h5>LAPORAN PEMINJAMAN BUKU SELESAI</h5>

    <table>
        <thead>
            <tr class="bg-success">
                <th>NO</th>
                <th>NAMA PEMINJAM</th>
                <th>JUDUL BUKU</th>
                <th>JUMLAH PINJAM</th>
                <th>TGL PINJAM</th>
                <th>TGL KEMBALI</th>
                <th>KEPERLUAN</th>
            </tr>
        </thead>
        <tbody>
            @if (count($datas))
                @foreach ($datas as $index => $item)
                    <tr>
                        <td>{{ $datas->firstItem() + $index }}</td>
                        <td>{{ $item->nama_peminjam }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->jumlah_pinjam }}</td>
                        <td>{{ $item->tgl_pinjam }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td>{{ $item->keperluan }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data peminjaman</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d F Y H:i:s') }}</p>
    </div>
</body>
</html>
