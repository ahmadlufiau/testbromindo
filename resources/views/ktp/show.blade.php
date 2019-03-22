@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('ktp.index')}}" class="btn btn-primary">Back</a>
                </div>
                <div class="card-body">
                        <table class="table">
                            <tr>
                                <td width="170px">NIK</td>
                                <td>:</td>
                                <td>{{ $ktp->nik}}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $ktp->nama}}</td>
                            </tr>
                            <tr>
                                <td>Tempat, Tanggal Lahir</td>
                                <td>:</td>
                                <td>{{ $ktp->tempatlahir}}, {{ App\Lib::convertdate($ktp->tanggallahir)}}</td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td>:</td>
                                <td>{{ $ktp->age }} Tahun</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                @if($ktp->jekel == NULL)
                                    <td> - </td>
                                @else
                                    <td>{{ App\Lib::gender($ktp->jekel) }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $ktp->alamat }}</td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>:</td>
                                <td>{{ App\Lib::agama($ktp->agama) }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                @if($ktp->status == NULL)
                                    <td> - </td>
                                @else
                                    <td>{{ App\Lib::status($ktp->status) }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td>Foto</td>
                                <td>:</td>
                                @if($ktp->foto == NULL)
                                    <td><img src="default/no_image.png" width="150px" height="150px"></td>
                                @else
                                    <td><img src="foto/sm-{{ $ktp->foto }}"></td>
                                @endif
                            </tr>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
