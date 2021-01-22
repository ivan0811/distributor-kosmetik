<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'id' => '1',
                'role_id' => '1',
                'name' => 'Admin',
                'username' => 'admin',
                'no_hp' => '0',
                'jk' => null,
                'kabupaten' => '-',
                'kecamatan' => '-',
                'alamat' => '-',
                'email' => 'admin@mail.com',
                'password' => Hash::make('admin')
            ],
            [
                'id' => '2',
                'role_id' => '2',
                'name' => 'Ivan Faathirza',
                'username' => 'ivan',
                'no_hp' => '089662040250',
                'jk' => 'L',
                'kabupaten' => 'kuningan',
                'kecamatan' => 'cilimus',
                'alamat' => 'desa caracas',
                'email' => 'ivanfaathirza@gmail.com',
                'password' => Hash::make('12345678')
            ]
        ]);
    }
}
