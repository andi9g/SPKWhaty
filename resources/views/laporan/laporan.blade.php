<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Data Ranking</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
        }
        table {
            font-size: 9pt;
        }
    </style>
</head>
<body>
    <h1>Laporan Data Ranking</h1>
    <h6>Dicetak oleh : {{Session::get('nama')}} ({{Session::get('posisi')}})</h6>

    <table border="1" style="border-collapse: collapse;width:100%">
        <tr>
            <th>No</th>
            <th>Gambar/Logo</th>
            <th>Nama Instansi</th>
            <th>Alamat</th>
            <th>Nomor HP</th>
            <th>Hasil Pencarian</th>
        </tr>

        @foreach ($data as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td align="center" style="text-center"><img src="{{ url('gambar/instansi', [$item->gambar]) }}" width="45px" alt=""></td>
                <td style="font-weight: bold">{{$item->namainstansi}}</td>
                <td>{{$item->alamat}}</td>
                <td>{{$item->hp}}</td>
                <td align="center">{{$item->nilai}}</td>
            </tr>
        @endforeach
    </table>
    
</body>
</html>