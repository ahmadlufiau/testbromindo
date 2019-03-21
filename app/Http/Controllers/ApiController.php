<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ktp;

class ApiController extends Controller
{
    public function index()
    {
        $ktp = Ktp::orderBy('created_at', 'DESC')->select('nik', 'nama', 'tempatlahir', 'tanggallahir', 'alamat', 'foto', 'created_at')->paginate(10);
        return response($ktp, 200);
    }

    public function show($nik)
    {
        $ktp = Ktp::find($nik);
        return response($ktp, 200);
    }
}
