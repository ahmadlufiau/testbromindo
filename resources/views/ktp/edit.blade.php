@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row col-md-12" style="padding-bottom:12px">
        <a href="{{ route('ktp.index')}}" class="btn btn-warning">Back</a>
	</div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Data KTP</div>
                <div class="card-body">
                    <form action="{{ route('ktp.update', $ktp->nik) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label>Nama*</label>
                                <input type="nama" name="nama" class="form-control" placeholder="Masukkan Nama" value="{{ $ktp->nama }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-control-label">Tempat Lahir*</label>
                                <input class="form-control"type="text" name="tempatlahir" placeholder="Masukkan Tempat Lahir" value="{{ $ktp->tempatlahir }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-control-label">Tanggal Lahir*</label>
                                <input class="form-control"type="date" name="tanggallahir" placeholder="Masukkan Tanggal Lahir" value="{{ $ktp->tanggallahir }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat*</label>
                            <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat" value="{{ $ktp->alamat }}">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label class="form-control-label">Jenis Kelamin*</label>
                                <select name="jekel" class="form-control">
                                    @foreach ($jekel as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-control-label">Agama*</label>
                                <select name="agama" class="form-control">
                                    @foreach ($agama as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-control-label">Status*</label>
                                <select name="status" class="form-control">
                                    @foreach ($status as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label class="form-control-label">Foto</label>
                                <input type="file" name="foto" class="form-control">
                            </div>
                            <img src="{{ url('foto', 'sm-'.$ktp->foto )}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
