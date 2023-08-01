<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KecamatanModel;

class KecamatanController extends Controller
{
    public function __construct() 
    {
        $this->KecamatanModel = new KecamatanModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $data= [
            'title' => 'Kecamatan',
            'kecamatan' => $this->KecamatanModel->AllData(),
        ];
        return view('admin.kecamatan.v_index', $data);
    }

    public function add()
    {
        $data= [
            'title' => 'Add Data Kecamatan',
        ];
        return view('admin.kecamatan.v_add', $data);
    }

    public function insert() 
    {
        Request()->validate(
            [
                'kecamatan' => 'required',
                'warna' => 'required',
                'geojson' => 'required',
            ],
            [
                'kecamatan.required' => 'Wajib diisi !!!',
                'warna.required' => 'Wajib diisi !!!',
                'geojson.required' => 'Wajib diisi !!!',
            ]
        );

        //Jika validasi tidak ada maka lakukan simpan data ke database

        $data = [
            'kecamatan' => Request()->kecamatan,
            'warna' => Request()->warna,
            'geojson' => Request()->geojson,
        ];

        $this->KecamatanModel->InsertData($data);
        return redirect()->route('kecamatan')->with('pesan', 'Data Berhasil Ditambahkan');

    }
}
