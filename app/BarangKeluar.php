<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluar';
    protected $fillable = ['id', 'barang_id', 'jumlah'];

    public function barang()
    {
        return $this->belongsTo('App/Barang');
    }
    
    public function DetailPesanan()
    {
        return $this->belongsTo(DetailPesanan::class);
    }
}
