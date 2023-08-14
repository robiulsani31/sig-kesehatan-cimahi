<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tempat_Layanan;
use App\Models\Kategori;
use App\Models\KecamatanModel;


class Tempat_LayananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->Tempat_Layanan = new Tempat_Layanan();
        $this->Kategori = new Kategori();
        $this->KecamatanModel = new KecamatanModel();
    }

    public function index()
    {
        $data= [
            'title' => 'Tempat Layanan Kesehatan',
            'tempat_layanan' => $this->Tempat_Layanan->AllData(),
        ];
        return view('admin.tempat_layanan.v_index', $data);
    }

    public function add()
    {
        $data= [
            'title' => 'Add Tempat Layanan',
            'kategori' => $this->Kategori->AllData(),
            'kecamatan' => $this->KecamatanModel->AllData(),
            
        ];
        return view('admin.tempat_layanan.v_add', $data);
    }

    public function insert() 
    {
        Request()->validate(
            [
                'nama_tempat' => 'required',
                'id_kategori' => 'required',
                'id_kecamatan' => 'required',
                'alamat' => 'required',
                'posisi' => 'required',
                'foto' => 'required|max:1024',
                'deskripsi' => 'required',
            ],
            [
                'nama_tempat.required' => 'Wajib diisi !!!',
                'id_kategori.required' => 'Wajib diisi !!!',
                'id_kecamatan.required' => 'Wajib diisi !!!',
                'alamat.required' => 'Wajib diisi !!!',
                'posisi.required' => 'Wajib diisi !!!',
                'foto.required' => 'Wajib diisi !!!',
                'foto.max' => 'Foto Max 1024 KB',
                'deskripsi.required' => 'Wajib diisi !!!',
            ]
        );

        //Jika validasi tidak ada maka lakukan simpan data ke database

        $file = Request()->foto;
        $filename = $file->getClientOriginalName();
        $file->move(public_path('foto'), $filename);

        $data = [
            'nama_tempat' => Request()->nama_tempat,
            'id_kategori' => Request()->id_kategori,
            'id_kecamatan' => Request()->id_kecamatan,
            'alamat' => Request()->alamat,
            'posisi' => Request()->posisi,
            'foto' => $filename,
            'deskripsi' => Request()->deskripsi,
        ];

        $this->Tempat_Layanan->InsertData($data);
        return redirect()->route('tempat_layanan')->with('pesan', 'Data Berhasil Ditambahkan');
    }
    
    public function edit($id_tempat)
    {
        $data= [
            'title' => 'Edit Tempat Layanan',
            'kategori' => $this->Kategori->AllData(),
            'kecamatan' => $this->KecamatanModel->AllData(),
            'tempat_layanan' => $this->Tempat_Layanan->DetailData($id_tempat),
            
        ];
        return view('admin.tempat_layanan.v_edit', $data);
    }

    public function update($id_tempat)
    {
        Request()->validate(
            [
                'nama_tempat' => 'required',
                'id_kategori' => 'required',
                'id_kecamatan' => 'required',
                'alamat' => 'required',
                'posisi' => 'required',
                'foto' => 'max:1024',
                'deskripsi' => 'required',
            ],
            [
                'nama_tempat.required' => 'Wajib diisi !!!',
                'id_kategori.required' => 'Wajib diisi !!!',
                'id_kecamatan.required' => 'Wajib diisi !!!',
                'alamat.required' => 'Wajib diisi !!!',
                'posisi.required' => 'Wajib diisi !!!',
                'foto.required' => 'Wajib diisi !!!',
                'foto.max' => 'Foto Max 1024 KB',
                'deskripsi.required' => 'Wajib diisi !!!',
            ]);

        if (Request()->foto <> "") {
            // jika ingin ganti foto
            $file = Request()->foto;
            $filename = $file->getClientOriginalName();
            $file->move(public_path('foto'), $filename);

            $data = [
                'nama_tempat' => Request()->nama_tempat,
                'id_kategori' => Request()->id_kategori,
                'id_kecamatan' => Request()->id_kecamatan,
                'alamat' => Request()->alamat,
                'posisi' => Request()->posisi,
                'foto' => $filename,
                'deskripsi' => Request()->deskripsi,
            ];
            $this->Tempat_Layanan->UpdateData($id_tempat, $data);
    
        }
        else {
            // jika tidak ganti foto
            $data = [
                'nama_tempat' => Request()->nama_tempat,
                'id_kategori' => Request()->id_kategori,
                'id_kecamatan' => Request()->id_kecamatan,
                'alamat' => Request()->alamat,
                'posisi' => Request()->posisi,
                'deskripsi' => Request()->deskripsi,
            ];
            $this->Tempat_Layanan->UpdateData($id_tempat, $data);
        }
        return redirect()->route('tempat_layanan')->with('pesan', 'Data Berhasil Di Update');
    }

    public function delete($id_tempat)
    {
        //hapus foto lama
        $tempat_layanan= $this->Tempat_Layanan->DetailData($id_tempat);
        if ($tempat_layanan->foto <> "") {
            unlink(public_path('foto') . '/' . $tempat_layanan->foto);
        }
        
        $this->Tempat_Layanan->DeleteData($id_tempat);
        return redirect()->route('tempat_layanan')->with('pesan', 'Data Berhasil Di Delete');
    }
}
