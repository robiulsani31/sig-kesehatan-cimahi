<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tempat_Layanan;
use App\Models\Kategori;
use App\Models\KecamatanModel;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->Kategori = new Kategori();
        $this->KecamatanModel = new KecamatanModel();
        $this->Tempat_Layanan = new Tempat_Layanan();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data= [
            'title' => 'Dashboard',
            'kecamatan' => DB::table('tbl_kecamatan')->count(),
            'kategori' => DB::table('kategoris')->count(),
            'tempat_layanan' => DB::table('tbl_tempat_layanan')->count(),
            'user' => DB::table('users')->count(),
            'kec' => $this->KecamatanModel->AllData(),
            'kat' => $this->Kategori->AllData(),
            'temp' => $this->Tempat_Layanan->AllData(),

        ];
        return view('v_home', $data);
    }
}
