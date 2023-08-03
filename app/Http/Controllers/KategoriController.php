<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->Kategori = new Kategori();
    }

    public function index()
    {
        $data= [
            'title' => 'Kategori Layanan',
            'kategori' => $this->Kategori->AllData()
        ];
        return view('admin.kategori.v_index', $data);
    }
}
