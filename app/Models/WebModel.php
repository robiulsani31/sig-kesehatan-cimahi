<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WebModel extends Model
{
    public function DataKecamatan()
    {
        return DB::table('tbl_kecamatan')
            ->get();
    }

    public function DataKategori()
    {
        return DB::table('kategoris')
            ->get();
    }

    public function DetailKecamatan($id_kecamatan)
    {
        return DB::table('tbl_kecamatan')
            ->where('id_kecamatan', $id_kecamatan)->first();
    }

    public function DetailKategori($id_kategori)
    {
        return DB::table('kategoris')
            ->where('id_kategori', $id_kategori)->first();
    }

    public function DataTempatLayanan($id_kecamatan)
    {
        return DB::table('tbl_tempat_layanan')
            ->join('kategoris', 'kategoris.id_kategori', '=', 'tbl_tempat_layanan.id_kategori')
            ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan', '=', 'tbl_tempat_layanan.id_kecamatan')
            ->where('tbl_tempat_layanan.id_kecamatan', $id_kecamatan)
            ->get();
    }

    public function DataKategoriTempatLayanan($id_kategori)
    {
        return DB::table('tbl_tempat_layanan')
            ->join('kategoris', 'kategoris.id_kategori', '=', 'tbl_tempat_layanan.id_kategori')
            ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan', '=', 'tbl_tempat_layanan.id_kecamatan')
            ->where('tbl_tempat_layanan.id_kategori', $id_kategori)
            ->get();
    }

    public function AllDataTempatLayanan()
    {
        return DB::table('tbl_tempat_layanan')
            ->join('kategoris', 'kategoris.id_kategori', '=', 'tbl_tempat_layanan.id_kategori')
            ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan', '=', 'tbl_tempat_layanan.id_kecamatan')
            ->get();
    }

    public function DetailDataTempatLayanan($id_tempat)
    {
        return DB::table('tbl_tempat_layanan')
            ->join('kategoris', 'kategoris.id_kategori', '=', 'tbl_tempat_layanan.id_kategori')
            ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan', '=', 'tbl_tempat_layanan.id_kecamatan')
            ->where('id_tempat', $id_tempat)
            ->first();
    }


}
