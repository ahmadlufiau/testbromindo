<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ktp;
use DB;
use PDF;
use Excel;

class LaporanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function exportPdf()
    {
        // set limit memory (data yang diatas >40000)
        ini_set('memory_limit', '2048M');
        // set maks execture (dompdf export data yang diatas >40000)
        ini_set('max_execution_time', 900);
        $ktp = DB::table('ktp')
            ->select('nik', 'nama', 'tempatlahir', 'tanggallahir', 'jekel', 'alamat', 'agama', 'status')
            ->get();
        $pdf = PDF::loadView('ktp.exportpdf', ['ktp' => $ktp]);
        return $pdf->download('export-ktp.pdf');
    }

    public function exportCsv()
    {
        // set limit memory (data yang diatas >40000)
        ini_set('memory_limit', '2048M');
        $ktp = Ktp::select('nik', 'nama', 'tempatlahir', 'tanggallahir', 'jekel', 'alamat', 'agama', 'status')->get();
        return Excel::create('exportKtp',  function ($excel)  use ($ktp) {
            $excel->sheet('mysheet',  function ($sheet)  use ($ktp) {
                $sheet->fromArray($ktp);
            });
        })->download('csv');
    }

    public function importCsv(Request $request)
    {
        // set limit memory (data yang diatas >40000)
        ini_set('memory_limit', '2048M');
        if ($request->file('imported-file')) {
            $path = $request->file('imported-file')->getRealPath();
            $data = Excel::load($path, function ($reader) { })->get();

            if (!empty($data) && $data->count()) {
                foreach ($data->toArray() as $row) {
                    if (!empty($row)) {
                        $dataArray[] =
                            [
                                'nik' => $row['nik'],
                                'nama' => $row['nama'],
                                'tempatlahir' => $row['tempatlahir'],
                                'tanggallahir' => $row['tanggallahir'],
                                'jekel' => $row['jekel'],
                                'alamat' => $row['alamat'],
                                'agama' => $row['agama'],
                                'status' => $row['status']
                            ];
                    }
                }
                if (!empty($dataArray)) {
                    Ktp::insert($dataArray);
                    return back();
                }
            }
        }
    }
}
