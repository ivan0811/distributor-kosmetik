<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/*
    NIM : 10119003
    Nama : Ivan Faathirza
    Kelas : IF1
*/
class Sales extends Model
{
    protected $table = 'sales';
    protected $fillable = ['nama', 'no_hp', 'jk', 'kabupaten', 'kecamatan', 'alamat'];

    public function pesanan(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'sales_id');
    }
}
