<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table = 'toko';
    protected $fillable = ['nama', 'kabupaten', 'kecamatan', 'no_hp', 'alamat'];    
    
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'toko_id');
    }
}
