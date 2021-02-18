<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $fillable = ['no_pesanan', 'toko_id', 'sales_id', 'total_harga'];
    
    public function DetailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'no_pesanan');
    }
    
    public function Pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'no_pesanan');
    }
    
    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }

    public function sales()
    {
        return $this->belongsTo(Sales::class);
    }
}
