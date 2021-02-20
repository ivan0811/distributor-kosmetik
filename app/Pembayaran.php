<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/*
    NIM : 10119003
    Nama : Ivan Faathirza
    Kelas : IF1
*/
class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $fillable = ['norek', 'no_pesanan', 'jumlah_pembayaran', 'metode_pembayaran', 'status_pembayaran'];
    
    public function rekening()
    {
        return $this->belongsTo(Rekening::class);
    }
    
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
    
}
