<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/*
    NIM : 10119003
    Nama : Ivan Faathirza
    Kelas : IF1
*/
class Rekening extends Model
{
    protected $table = 'rekening';
    protected $fillable = ['norek', 'kode_bank', 'atas_nama'];
    
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
    
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'norek');
    }
        
    public function Pemasok()
    {
        return $this->hasMany(Pemasok::class, 'norek');
    }
}
