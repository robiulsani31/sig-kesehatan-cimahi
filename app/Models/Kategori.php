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

    public function DetailData($id)
    {
        return DB::table('kategoris')
            ->where('id', $id)->first();
    }

    public function UpdateData($id, $data)
    {
        DB::table('kategoris')
        ->where('id',$id)
            ->update($data);
    }

    public function DeleteData($id)
    {
        DB::table('kategoris')
        ->where('id',$id)
            ->delete();
    }
}
