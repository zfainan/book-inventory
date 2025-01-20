<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Buku</title>
    <style>
        body { font-family: 'Arial', sans-serif; margin: 0; padding: 20px; }
        .kop-surat { 
            border-bottom: 3px solid black; 
            padding-bottom: 10px; 
            margin-bottom: 20px; 
            text-align: center; 
        }
        .kop-surat h3 { margin: 5px 0; }
        .kop-surat p { margin: 3px 0; font-size: 12px; }
        .blue-link { color: blue; text-decoration: underline; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: center; font-size: 12px; }
        th { background-color: #f2f2f2; }
        td:nth-child(6), td:nth-child(7) { text-align: right; } /* Kolom Harga dan Total rata kanan */
        .footer { 
            margin-top: 20px; 
            text-align: right; 
            font-size: 12px; 
        }
    </style>
</head>
<body>
    <div class="kop-surat">
        <img src="{{ public_path('img/Logosmkypkk.png') }}" alt=" " style="max-width: 140px; position: absolute; left: 10px; top: 30px;">
        <h3>SMK 1 YPKK SLEMAN</h3>
        <p>SMK 1 YPKK SLEMAN</p>
        <p>TERAKREDITASI A</p>
        <p>Alamat: Jl. Sidoarum-Gamping No.2, Mejing Wetan, Ambarketawang,</p>
        <p>Kec. Gamping, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55294</p>
        <p>Telp. (0274) 798806</p>
        <p>Website: <a href="http://smkypkk1gamping.sch" class="blue-link">http://smkypkk1gamping.sch</a> 
           Email: <a href="mailto:smkypkk1_gmp@yahoo.co.id" class="blue-link">smkypkk1_gmp@yahoo.co.id</a></p>
    </div>

    <h5 style="text-align: center; margin-bottom: 20px;">LAPORAN PENGAJUAN ACC</h5>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Jumlah</th>
                <th>Jenis</th>
                <th>Penerbit</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengajuan as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td style="text-align: left;">{{ $item->judul }}</td>                    
                <td>{{ $item->jumlah }}</td>                                  
                <td>{{ $item->jenis }}</td>
                <td style="text-align: left;">{{ $item->penerbit }}</td>  
                <td>{{ number_format($item->harga, 0, ',', '.') }}</td>                 
                <td>{{ number_format($item->jumlah * $item->harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d F Y H:i:s') }}</p>
    </div>
</body>
</html>
