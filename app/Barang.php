<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $fillable = ['nama', 'stok', 'harga_jual', 'harga_pabrik', 'discount'];
}
