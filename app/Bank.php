<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'bank';
    protected $fillable = ['kode_bank', 'nama_bank']; 

    public function bank()
    {
        return $this->hasMany(Bank::class, 'kode_bank');
    }
}

