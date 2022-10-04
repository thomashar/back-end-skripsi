<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')
        ->insert([
            'nama_menu' => 'Kopi Hitam',
            'harga_menu' => '10000',
            'deskripsi_menu' => 'Kopi hitam yang pahit dan hangat',
            'jenis_menu' => 'Kopi',
            'id_stok' => '1'
        ]);
        DB::table('menus')
        ->insert([
            'nama_menu' => 'Es Kopi Susu Gula Aren',
            'harga_menu' => '15000',
            'deskripsi_menu' => 'Es kopi dengan susu yang segar dan gula aren yang manis',
            'jenis_menu' => 'Kopi',
            'id_stok' => '1'
        ]);
        DB::table('menus')
        ->insert([
            'nama_menu' => 'Roti Bakar Cokelat',
            'harga_menu' => '10000',
            'deskripsi_menu' => 'Roti bakar isi cokelat yang hangat',
            'jenis_menu' => 'Makanan Ringan',
            'id_stok' => '5'
        ]);
        DB::table('menus')
        ->insert([
            'nama_menu' => 'Es Cokelat',
            'harga_menu' => '20000',
            'deskripsi_menu' => 'Es cokelat yang segar dan nikmat',
            'jenis_menu' => 'Non-Kopi',
            'id_stok' => '10'
        ]);
    }
}
