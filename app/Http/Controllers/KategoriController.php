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

    public function add()
    {
        $data= [
            'title' => 'Add Kategori Layanan',
            
        ];
        return view('admin.kategori.v_add', $data);
    }

    public function insert()
    {
        Request()->validate([
            'kategori' => 'required',
            'icon' => 'required',
        ],[
            'kategori.required' => 'Wajib Diisi',
            'icon.required' => 'Wajib Diisi',
        ]);

        $file = Request()->icon;
        $filename = $file->getClientOriginalName();
        $file->move(public_path('icon'), $filename);

        $data = [
            'kategori' => Request()->kategori,
            'icon' => $filename,
        ];

        $this->Kategori->InsertData($data);
        return redirect()->route('kategori')->with('pesan', 'Data Berhasil Ditambahkan');

    }

    public function edit($id_kategori)
    {
        $data= [
            'title' => 'Edit Kategori Layanan',
            'kategori' => $this->Kategori->DetailData($id_kategori),
        ];
        return view('admin.kategori.v_edit', $data);
    }

    public function update($id_kategori)
    {
        Request()->validate(
            [
                'kategori' => 'required',
            ],
            [
                'kategori.required' => 'Wajib diisi !!!',
            ]
        );

        if (Request()->icon <> "") {
            // jika ingin ganti icon
            $file = Request()->icon;
            $filename = $file->getClientOriginalName();
            $file->move(public_path('icon'), $filename);
            $data = [
                'kategori' => Request()->kategori,
                'icon' => $filename,
            ];
    
            $this->Kategori->UpdateData($id_kategori, $data);
        }
        else {
            // jika tidak ganti icon
            $data = [
                'kategori' => Request()->kategori,
            ];
    
            $this->Kategori->UpdateData($id_kategori, $data);
        }
        return redirect()->route('kategori')->with('pesan', 'Data Berhasil Di Update');

       

        $this->Kategori->UpdateData($id_kategori, $data);
        return redirect()->route('kecamatan')->with('pesan', 'Data Berhasil Di Update');
    }

    public function delete($id_kategori)
    {
        $this->Kategori->DeleteData($id_kategori);
        return redirect()->route('kategori')->with('pesan', 'Data Berhasil Di Delete');
    }
}
