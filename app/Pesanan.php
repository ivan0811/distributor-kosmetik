<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $fillable = ['no_pesanan', 'toko_id', 'sales_id', 'total_barang', 'total_harga'];
    
    public function DetailPesanan()
    {
        return $this->belongsTo(DetalPesanan::class, 'no_pesanan');
    }
}
