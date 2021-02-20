<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/*
    NIM : 10119003
    Nama : Ivan Faathirza
    Kelas : IF1
*/
class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['name'];

    public function user()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
