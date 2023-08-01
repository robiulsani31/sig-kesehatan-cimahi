<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KecamatanModel extends Model
{
    public function AllData()
    {
        return DB::table('tbl_kecamatan')->get();
    }

    public function InsertData($data)
    {
        DB::table('tbl_kecamatan')->insert($data);
    }
}
