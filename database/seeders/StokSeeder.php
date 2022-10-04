<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stoks')->
        insert([
            'nama_stok' => 'Biji Kopi Lampung Robusta',
            'jumlah_masuk_stok' => '2',
            'satuan_stok' => 'Kg',
            'tanggal_masuk_stok' => '2022-08-01',
            'harga_stok' => '400000',
            'tanggal_kadaluarsa' => '2023-02-01'
        ]);
        DB::table('stoks')->
        insert([
            'nama_stok' => 'Gula Aren',
            'jumlah_masuk_stok' => '1',
            'satuan_stok' => 'Kg',
            'tanggal_masuk_stok' => '2022-08-01',
            'harga_stok' => '70000',
            'tanggal_kadaluarsa' => '2023-02-01'
        ]);
        DB::table('stoks')->
        insert([
            'nama_stok' => 'Sirup Vanilla',
            'jumlah_masuk_stok' => '1',
            'satuan_stok' => 'Liter',
            'tanggal_masuk_stok' => '2022-08-02',
            'harga_stok' => '120000',
            'tanggal_kadaluarsa' => '2023-02-02'
        ]);
        DB::table('stoks')->
        insert([
            'nama_stok' => 'Sirup Caramel',
            'jumlah_masuk_stok' => '1',
            'satuan_stok' => 'Liter',
            'tanggal_masuk_stok' => '2022-08-02',
            'harga_stok' => '120000',
            'tanggal_kadaluarsa' => '2023-02-02'
        ]);
        DB::table('stoks')->
        insert([
            'nama_stok' => 'Roti Tawar (10)',
            'jumlah_masuk_stok' => '2',
            'satuan_stok' => 'Buah',
            'tanggal_masuk_stok' => '2022-08-02',
            'harga_stok' => '30000',
            'tanggal_kadaluarsa' => '2022-08-06'
        ]);
        DB::table('stoks')->
        insert([
            'nama_stok' => 'Mentega',
            'jumlah_masuk_stok' => '200',
            'satuan_stok' => 'gram',
            'tanggal_masuk_stok' => '2022-08-02',
            'harga_stok' => '7000',
            'tanggal_kadaluarsa' => '2023-02-02'
        ]);
        DB::table('stoks')->
        insert([
            'nama_stok' => 'Meses Coklat',
            'jumlah_masuk_stok' => '300',
            'satuan_stok' => 'gram',
            'tanggal_masuk_stok' => '2022-08-02',
            'harga_stok' => '18000',
            'tanggal_kadaluarsa' => '2023-02-02'
        ]);
    }
}
