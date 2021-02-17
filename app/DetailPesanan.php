<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $table = 'detail_pesanan';
    protected $fillable = ['no_pesanan', 'barang_id', 'satuan', 'qty', 'total_harga'];

    /**
     * Get the user that owns the DetailPesanan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class);
    }

    /**
     * Get all of the comments for the DetailPesanan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function barangKeluar(): HasMany
    {
        return $this->hasMany(DetailPesanan::class, 'detail_pesanan_id');
    }
}
