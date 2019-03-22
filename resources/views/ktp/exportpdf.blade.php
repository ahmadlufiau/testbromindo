<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title>Export KTP</title>
	<style>
		table {
            width: 100%;
            border-collapse: collapse;
		}
		td,th {
            text-align: left;
            padding: 5px;
            border:1px solid;
		}
	</style>
</head>
<body style="font-size: 12px;">
	<center><h3 style="margin-right: 10px;">PT BROMINDO MEKAR PUTRA</h3></center>
        <center><p style="margin-right: 20px;">Jl. Perintis Kemerdekaan 37E Pudakpayung Semarang, Jawa Tengah 50265</p></center>==========================================================================================================
    </center>
    <br>
    <table>
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Status</th>
                <th>Agama</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ktp as $dataktp)
            <tr>
                <td>{{ $dataktp->nik }}</td>
                <td>{{ $dataktp->nama }}</td>
                <td>{{ $dataktp->tempatlahir }}</td>
                <td>{{ App\Lib::convertdate($dataktp->tanggallahir)}}</td>
                <td>
                    @if($dataktp->jekel == NULL)
                    -
                    @else
                    {{ App\Lib::gender($dataktp->jekel)}}
                    @endif
                </td>
                <td>
                    @if($dataktp->status == NULL)
                    -
                    @else
                    {{ App\Lib::status($dataktp->status)}}
                    @endif
                </td>
                <td>{{ App\Lib::agama($dataktp->agama)}}</td>
            </tr>
            @endforeach
        <tbody>
    </table>
</body>
</html>
