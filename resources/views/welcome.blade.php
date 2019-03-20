@extends('layouts.app')

@section('content')
<div class="container">
    <?php
    $admin = Auth::User()->isAdmin();
    $user = Auth::user()->isUser();
    ?>
    <div class="row col-md-12 pb-4">
        @if($admin == 1)
        <a href="{{ route('ktp.create')}}" class="btn btn-info">Tambah Data</a>
        <a href="#" class="btn btn-info ml-2">Export CSV</a>
        <a href="#" class="btn btn-info ml-2">Export PDF</a>
        @endif
        @if($user == 1)
        <a href="#" class="btn btn-info">Export CSV</a>
        <a href="#" class="btn btn-info ml-2">Export PDF</a>
        @endif
	</div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">NIK</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tempat Tanggal Lahir</th>
                                <th scope="col">Umur</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ktp as $dataktp)
                                <tr>
                                <th scope="row">{{ $dataktp->nik }}</th>
                                <td>{{ $dataktp->nama }}</td>
                                <td>{{ $dataktp->tempatlahir }}, {{ App\Lib::convertdate($dataktp->tanggallahir)}}</td>
                                <td>{{ $dataktp->age }} Tahun</td>
                                <td>{{ App\Lib::gender($dataktp->jekel) }}</td>
                                <td>{{ $dataktp->alamat }}</td>
                                <td><img src="foto/sm-{{ $dataktp->foto }}"></td>
                                @if($user == 1)
                                <td>
                                    <a class="btn btn-primary btn-xs" href="{{ route('ktp.show', $dataktp->nik) }}">Detail</a>
                                </td>
                                @endif
                                @if($admin == 1)
                                <td>
                                    <form action="{{ route('ktp.destroy', $dataktp->nik) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a class="btn btn-warning btn-xs" href="{{ route('ktp.edit', $dataktp->nik) }}">Edit</a>
                                        <a class="btn btn-primary btn-xs" href="{{ route('ktp.show', $dataktp->nik) }}">Detail</a>
                                        <button class="btn btn-danger btn-xs" type="submit">Delete</button>
                                    </form>
                                </td>
                                @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
