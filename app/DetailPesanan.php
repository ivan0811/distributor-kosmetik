<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $table = 'detail_pesanan';
    protected $fillable = ['no_pesanan', 'barang_id', 'satuan', 'qty', 'total_harga', 'discount'];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function barangKeluar()
    {
        return $this->hasMany(DetailPesanan::class, 'detail_pesanan_id');
    }
}
