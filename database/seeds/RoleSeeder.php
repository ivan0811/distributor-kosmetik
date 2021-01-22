<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        role::insert([
            [
                'id' => '1',
                'name' => 'admin'
            ],
            [
                'id' => '2',
                'name' => 'petugas'
            ]
        ]);
    }
}
