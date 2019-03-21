<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ktp;
use App\Lib;

class KtpController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    private $rules = [
        'nik' => ['required'],
        'nama' => ['required'],
        'tempatlahir' => ['required'],
        'tanggallahir' => ['required'],
        'jekel' => ['required'],
        'alamat' => ['required'],
        'agama' => ['required'],
        'status' => ['required']
    ];

    public $status = ['0' => 'Belum Kawin', '1' => 'Kawin'];
    public $jekel = ['0' => 'Laki-Laki', '1' => 'Perempuan'];
    public $agama = [
        '0' => 'Islam',
        '1' => 'Kristen',
        '2' => 'Katolik',
        '3' => 'Hindu',
        '4' => 'Buddha',
        '5' => 'Kong Hu Cu'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ktp = Ktp::orderBy('created_at', 'DESC')->select('nik', 'nama', 'tempatlahir', 'tanggallahir', 'jekel', 'alamat', 'agama', 'status', 'foto', 'created_at')->paginate(10);
        return view('welcome', ['ktp' => $ktp]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("ktp.create", ['agama' => $this->agama, 'status' => $this->status, 'jekel' => $this->jekel]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, $this->rules);
        $ktp = new Ktp;
        $ktp->nik = '4674';
        $ktp->nama = $request->nama;
        $ktp->tempatlahir = $request->tempatlahir;
        $ktp->tanggallahir = $request->tanggallahir;
        $ktp['tanggallahir'] = date('Y-m-d', strtotime($ktp['tanggallahir']));
        $ktp->jekel = $request->jekel;
        $ktp->alamat = $request->alamat;
        $ktp->agama = $request->agama;
        $ktp->status = $request->status;
        if ($request->hasFile('foto')) {
            $file = $request->foto;
            $filename = str_random(20) . base64_encode($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            Lib::compress('foto/', $file, $filename);
            $ktp->foto = $filename;
        }
        $ktp->save();
        return redirect('/')->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nik)
    {
        //
        $ktp = Ktp::find($nik);
        return view('ktp.show', ['ktp' => $ktp]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nik)
    {
        //
        $ktp = Ktp::find($nik);
        return view('ktp.edit', ['ktp' => $ktp, 'agama' => $this->agama, 'status' => $this->status, 'jekel' => $this->jekel]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nik)
    {
        //
        $this->validate($request, $this->rules);
        $ktp = Ktp::find($nik);
        $ktp->nik = '4674';
        $ktp->nama = $request->nama;
        $ktp->tempatlahir = $request->tempatlahir;
        $ktp->tanggallahir = $request->tanggallahir;
        $ktp['tanggallahir'] = date('Y-m-d', strtotime($ktp['tanggallahir']));
        $ktp->jekel = $request->jekel;
        $ktp->alamat = $request->alamat;
        $ktp->agama = $request->agama;
        $ktp->status = $request->status;
        if ($request->hasFile('foto')) {
            $file = $request->foto;
            $filename = str_random(20) . base64_encode($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            Lib::compress('foto/', $file, $filename);
            $ktp->foto = $filename;
        }
        $ktp->save();
        return redirect('/')->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nik)
    {
        $ktp = Ktp::find($nik);
        if ($ktp->foto != "") {
            if (file_exists('foto/sm-' . $ktp->foto)) {
                unlink('foto/sm-' . $ktp->foto);
            }

            if (file_exists('foto/xl-' . $ktp->foto)) {
                unlink('foto/xl-' . $ktp->foto);
            }

            if (file_exists('foto/md-' . $ktp->foto)) {
                unlink('foto/md-' . $ktp->foto);
            }
        }
        $ktp->delete();
        return redirect('/')->with('success', 'Data Berhasil Dihapus');
    }
}
