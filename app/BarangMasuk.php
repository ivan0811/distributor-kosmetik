<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';
    protected $fillable = ['barang_id', 'kode_pabrik', 'tanggal', 'jumlah'];
    
    public function Barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function Pemasok()
    {
        return $this->belongsTo(Pemasok::class);
    }
}
