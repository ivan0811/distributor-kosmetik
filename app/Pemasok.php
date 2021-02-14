<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    protected $table = 'pemasok';
    protected $fillable = ['kode_pabrik', 'kode_bpom', 'kabupaten', 'kecamatan', 'alamat'];
}
