<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')
                ->insert([
                    'nama_role' => 'Pemilik',
                ]);
        DB::table('roles')
                ->insert([
                    'nama_role' => 'Admin',
                ]);
        DB::table('roles')
                ->insert([
                    'nama_role' => 'Kasir',
                ]);
        DB::table('roles')
                ->insert([
                    'nama_role' => 'Pegawai',
                ]);
    }
}
