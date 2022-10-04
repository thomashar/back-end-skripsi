<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembeliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pembelis')->insert(['nama_pembeli' => 'Budi','email_pembeli' => 'budi@gmail.com']);
        DB::table('pembelis')->insert(['nama_pembeli' => 'citra','email_pembeli' => 'citra@gmail.com']);
        DB::table('pembelis')->insert(['nama_pembeli' => 'Dewi','email_pembeli' => 'dewi@gmail.com']);
    }
}
