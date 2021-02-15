<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $fillable = ['user_id', 'nama', 'stok', 'harga_jual', 'harga_pabrik', 'discount'];

    public function satuan()
    {
        return $this->belongsTo('App\Satuan');
    }
}
