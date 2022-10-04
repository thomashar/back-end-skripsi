<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistoryStokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('historystoks')->
        insert([
            'nama_stok' => 'Biji Kopi Lampung Robusta',
            'jumlah_stok' => '2',
            'satuan_stok' => 'Kg',
            'tanggal_stok' => '2022-08-01',
            'harga_stok' => '400000',
            'status_stok' => '1',
            'id_menu' => '1'
        ]);
        DB::table('historystoks')->
        insert([
            'nama_stok' => 'Gula Aren',
            'jumlah_stok' => '1',
            'satuan_stok' => 'Kg',
            'tanggal_stok' => '2022-08-01',
            'harga_stok' => '70000',
            'status_stok' => '1',
            'id_menu' => '2'
        ]);
        DB::table('historystoks')->
        insert([
            'nama_stok' => 'Sirup Vanilla',
            'jumlah_stok' => '1',
            'satuan_stok' => 'Liter',
            'tanggal_stok' => '2022-08-02',
            'harga_stok' => '120000',
            'status_stok' => '1',
            'id_menu' => '5'
        ]);
        DB::table('historystoks')->
        insert([
            'nama_stok' => 'Roti Tawar (10)',
            'jumlah_stok' => '2',
            'satuan_stok' => 'Buah',
            'tanggal_stok' => '2022-08-02',
            'harga_stok' => '30000',
            'status_stok' => '1',
            'id_menu' => '3'
        ]);
        DB::table('historystoks')->
        insert([
            'nama_stok' => 'Mentega',
            'jumlah_stok' => '200',
            'satuan_stok' => 'gram',
            'tanggal_stok' => '2022-08-02',
            'harga_stok' => '7000',
            'status_stok' => '0',
            'id_menu' => '3'
        ]);
        DB::table('historystoks')->
        insert([
            'nama_stok' => 'Mentega',
            'jumlah_stok' => '200',
            'satuan_stok' => 'gram',
            'tanggal_stok' => '2022-08-02',
            'harga_stok' => '7000',
            'status_stok' => '1',
            'id_menu' => '3'
        ]);
        DB::table('historystoks')->
        insert([
            'nama_stok' => 'Meses Coklat',
            'jumlah_stok' => '300',
            'satuan_stok' => 'gram',
            'tanggal_stok' => '2022-08-02',
            'harga_stok' => '18000',
            'status_stok' => '1',
            'id_menu' => '3'
        ]);
        DB::table('historystoks')->
        insert([
            'nama_stok' => 'Cadburry Dairy Milk (10)',
            'jumlah_stok' => '1',
            'satuan_stok' => 'Kantung',
            'tanggal_stok' => '2022-08-02',
            'harga_stok' => '40000',
            'status_stok' => '1',
            'id_menu' => '4'
        ]);
    }
}
