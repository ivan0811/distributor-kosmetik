<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    protected $table = 'rekening';
    protected $fillable = ['norek', 'kode_bank', 'atas_nama'];
}
