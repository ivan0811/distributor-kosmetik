<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    protected $table = 'pemasok';
    protected $fillable = ['kode_pabrik', 'norek', 'nama', 'provinsi', 'kabupaten', 'kecamatan', 'alamat'];
    
    /**
     * Get all of the comments for the Pemasok
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'kode_pabrik');
    }

    /**
     * Get the user that owns the Pemasok
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Rekening()
    {
        return $this->belongsTo(rekening::class);
    }
}
