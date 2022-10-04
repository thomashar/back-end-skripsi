<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reseps')
            ->insert([
                    'nama_resep' => 'Kopi',
                    'jumlah_resep' => '15',
                    'id_menu' => '1'
                ]);
        DB::table('reseps')
            ->insert([
                    'nama_resep' => 'Kopi',
                    'jumlah_resep' => '15',
                    'id_menu' => '2'
                ]);
        DB::table('reseps')
            ->insert([
                    'nama_resep' => 'Susu Full Cream',
                    'jumlah_resep' => '150',
                    'id_menu' => '2'
                ]);
        DB::table('reseps')
            ->insert([
                    'nama_resep' => 'Gula Aren',
                    'jumlah_resep' => '15',
                    'id_menu' => '2'
                ]);
        DB::table('reseps')
            ->insert([
                    'nama_resep' => 'Es Batu',
                    'jumlah_resep' => '50',
                    'id_menu' => '2'
                ]);
        DB::table('reseps')
            ->insert([
                    'nama_resep' => 'Roti Tawar',
                    'jumlah_resep' => '2',
                    'id_menu' => '3'
                ]);
        DB::table('reseps')
            ->insert([
                    'nama_resep' => 'Meses Coklat',
                    'jumlah_resep' => '30',
                    'id_menu' => '3'
                ]);
        DB::table('reseps')
            ->insert([
                    'nama_resep' => 'Cadburry Chocolate Drink',
                    'jumlah_resep' => '1',
                    'id_menu' => '4'
                ]);
        DB::table('reseps')
            ->insert([
                    'nama_resep' => 'Es Batu',
                    'jumlah_resep' => '50',
                    'id_menu' => '4'
                ]);
        DB::table('reseps')
            ->insert([
                    'nama_resep' => 'Kopi',
                    'jumlah_resep' => '15',
                    'id_menu' => '5'
                ]);
        DB::table('reseps')
            ->insert([
                    'nama_resep' => 'Sirup Vanilla',
                    'jumlah_resep' => '25',
                    'id_menu' => '5'
                ]);
        DB::table('reseps')
            ->insert([
                    'nama_resep' => 'Susu Full Cream',
                    'jumlah_resep' => '50',
                    'id_menu' => '5'
                ]);
        DB::table('reseps')
            ->insert([
                    'nama_resep' => 'Es Batu',
                    'jumlah_resep' => '50',
                    'id_menu' => '5'
                ]);
    }
}
