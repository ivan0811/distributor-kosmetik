<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'satuan';
    protected $fillable = ['id', 'nama'];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'satuan_id');
    }
}
