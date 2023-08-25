<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebModel;

class WebController extends Controller
{
    
    public function __construct() {
        $this->WebModel= new WebModel();
    }
    
    public function index()
    {
        $data= [
            'title' => 'Pemetaan',
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'kategori' => $this->WebModel->DataKategori(),
            'tempat_layanan' => $this->WebModel->AllDataTempatLayanan(),
        ];
        return view('v_web', $data);
    }

    public function kecamatan($id_kecamatan)
    {
        $kec = $this->WebModel->DetailKecamatan($id_kecamatan);
        $data= [
            'title' => 'Kecamatan ' . $kec->kecamatan,
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'tempat_layanan' => $this->WebModel->DataTempatLayanan($id_kecamatan),
            'kategori' => $this->WebModel->DataKategori(),
            'kec' => $kec,
        ];
        return view('v_kecamatan', $data);
    }

    public function kategori($id_kategori)
    {
        $kat = $this->WebModel->DetailKategori($id_kategori);
        $data= [
            'title' => 'Kategori ' . $kat->kategori,
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'tempat_layanan' => $this->WebModel->DataKategoriTempatLayanan($id_kategori),
            'kategori' => $this->WebModel->DataKategori(),
        ];
        return view('v_kategori', $data);
    }

    public function detailtempatlayanan($id_tempat)
    {
        $tempat = $this->WebModel->DetailDataTempatLayanan($id_tempat);
        $data= [
            'title' => 'Detail '. $tempat->nama_tempat,
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'kategori' => $this->WebModel->DataKategori(),
            'tempat' => $tempat,
        ];
        return view('v_detailtempatlayanan', $data);
    }
}
