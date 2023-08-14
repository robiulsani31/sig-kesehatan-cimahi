<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kategori extends Model
{
    public function AllData()
    {
        return DB::table('kategoris')
            ->get();
    }

    public function InsertData($data)
    {
        DB::table('kategoris')
            ->insert($data);
    }

    public function DetailData($id_kategori)
    {
        return DB::table('kategoris')
            ->where('id_kategori', $id_kategori)->first();
    }

    public function UpdateData($id_kategori, $data)
    {
        DB::table('kategoris')
        ->where('id_kategori',$id_kategori)
            ->update($data);
    }

    public function DeleteData($id_kategori)
    {
        DB::table('kategoris')
        ->where('id_kategori',$id_kategori)
            ->delete();
    }
}
