<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $fillable = ['user_id', 'satuan_id', 'kode_bpom', 'nama', 'stok', 'harga_jual', 'harga_pabrik', 'discount'];

    public function satuan()
    {
        return $this->belongsTo('App\Satuan');
    }

    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'barang_id');
    }

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'barang_id');
    }

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'barang_id');
    }
}
