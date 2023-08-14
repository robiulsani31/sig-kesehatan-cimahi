<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tempat_Layanan extends Model
{
    public function AllData()
    {
        return DB::table('tbl_tempat_layanan')
            ->join('kategoris', 'kategoris.id_kategori', '=', 'tbl_tempat_layanan.id_kategori')
            ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan', '=', 'tbl_tempat_layanan.id_kecamatan')
            ->get();
    }

    public function InsertData($data)
    {
        DB::table('tbl_tempat_layanan')
            ->insert($data);
    }

    public function DetailData($id_tempat)
    {
        return DB::table('tbl_tempat_layanan')
            ->join('kategoris', 'kategoris.id_kategori', '=', 'tbl_tempat_layanan.id_kategori')
            ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan', '=', 'tbl_tempat_layanan.id_kecamatan')
            ->where('id_tempat', $id_tempat)->first();
    }

    public function UpdateData($id_tempat, $data)
    {
        DB::table('tbl_tempat_layanan')
        ->where('id_tempat',$id_tempat)
            ->update($data);
    }

    public function DeleteData($id_tempat)
    {
        DB::table('tbl_tempat_layanan')
        ->where('id_tempat',$id_tempat)
            ->delete();
    }

}
