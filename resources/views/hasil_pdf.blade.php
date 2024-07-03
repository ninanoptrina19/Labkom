<!-- resources/views/hasil_pdf.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Penjadwalan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Hasil Penjadwalan</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Laboratorium</th>
                <th>Penggunaan/Mata kuliah</th>
                <th>Dosen</th>
                <th>Prodi</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Tahun Akademik</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hasil as $data)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $data->hari }}</td>
                    <td>{{ $data->jam }}</td>
                    <td>{{ $data->laboratorium->nama }}</td>
                    <td>{{ $data->penggunaan }}</td>
                    <td>{{ $data->dosen->nama }}</td>
                    <td>{{ $data->prodi }}</td>
                    <td>{{ $data->tanggal_mulai }}</td>
                    <td>{{ $data->tanggal_selesai }}</td>
                    <td>{{ $data->tahunAkademik->nama }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
