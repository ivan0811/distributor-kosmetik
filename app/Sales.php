<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'sales';
    protected $fillable = ['nama', 'no_hp', 'jk', 'kabupaten', 'kecamatan', 'alamat'];
}
