<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
    NIM : 10119026
    Nama : Muhammad Khatami
    Kelas : IF1
*/

class BarangKeluar extends Model
{
    protected $table = 'barang_keluar';
    protected $fillable = ['id', 'barang_id', 'detail_pesanan_id', 'jumlah'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
    
    public function DetailPesanan()
    {
        return $this->belongsTo(DetailPesanan::class);
    }
}
