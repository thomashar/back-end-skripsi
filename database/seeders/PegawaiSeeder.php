<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pegawais')
                ->insert([
                    'nama_pegawai' => 'Sipur Wibisono',
                    'jenis_kelamin' => 'Laki-laki',
                    'hp_pegawai' => '08138238211',
                    'alamat_pegawai' => 'Jl. Melati No.13',
                    'email_pegawai' => 'sipur@gmail.com',
                    'password' => '$2a$12$136z1m9z4PdeNTCN34VfR.n08/3mCHJ/jYVA2bFvX1uXAt/.xUc2S', //sipur123
                    'foto_pegawai' => '',
                    'jabatan_pegawai' => 'Pemilik',
                ]);
        DB::table('pegawais')
                ->insert([
                    'nama_pegawai' => 'Julius Donald',
                    'jenis_kelamin' => 'Laki-laki',
                    'hp_pegawai' => '081832428982',
                    'alamat_pegawai' => 'Jl. Solo Lama No.33',
                    'email_pegawai' => 'juliusganteng@gmail.com',
                    'password' => '$2a$12$LODNBUzPBtSgR5/oX8xOieD3YjTJi38nLSx9LPJAskmDCbXROVGwK', //juliusganteng123
                    'foto_pegawai' => '',
                    'jabatan_pegawai' => '3',
                ]);
        DB::table('pegawais')
                ->insert([
                    'nama_pegawai' => 'Felicyta Dara',
                    'jenis_kelamin' => 'Perempuan',
                    'hp_pegawai' => '081388221199',
                    'alamat_pegawai' => 'Jl. Kenanga No.31',
                    'email_pegawai' => 'felicytaDara@gmail.com',
                    'password' => '$2a$12$BxupBlzoMF4iGU8INDErt.rjGbi1dZElNIjsQ.5VLkqkDKOnU4NDm', //dara123
                    'foto_pegawai' => '',
                    'jabatan_pegawai' => '2',
                ]);
        DB::table('pegawais')
                ->insert([
                    'nama_pegawai' => 'Brigita Widya',
                    'jenis_kelamin' => 'Perempuan',
                    'hp_pegawai' => '08121626889',
                    'alamat_pegawai' => 'Jl. Indah No.22',
                    'email_pegawai' => 'gita@gmail.com',
                    'password' => '$2a$12$zXJi6nqj3gcO7aU.8Sm6nuyx9gxnPs7woTtjEliedlRyGOh4TcjxW', //gita123
                    'foto_pegawai' => '',
                    'jabatan_pegawai' => '4',
                ]);
        DB::table('pegawais')
                ->insert([
                    'nama_pegawai' => 'Alvin Yudhanto',
                    'jenis_kelamin' => 'Laki-laki',
                    'hp_pegawai' => '081899220033',
                    'alamat_pegawai' => 'Jl. Solo Baru No.44',
                    'email_pegawai' => 'alvin@gmail.com',
                    'password' => '$2a$12$URQXGbyPX0yC.Xz2ZnE1fenipjOkodXN4Ajfz.gHz98w5llNnshGW', //alvin123
                    'foto_pegawai' => '',
                    'jabatan_pegawai' => '3',
                ]);
        DB::table('pegawais')
                ->insert([
                    'nama_pegawai' => 'Nathanael Riefko',
                    'jenis_kelamin' => 'Laki-laki',
                    'hp_pegawai' => '081810293847',
                    'alamat_pegawai' => 'Jl. Mawar No.11',
                    'email_pegawai' => 'riefko@gmail.com',
                    'password' => '$2a$12$jQTyX.1z56xD4FPIMfmyau9MjkXh1yrElMqQGLbHnX2Nj9InqaBSe', //riefko123
                    'foto_pegawai' => '',
                    'jabatan_pegawai' => '2',
                ]);
        DB::table('pegawais')
                ->insert([
                    'nama_pegawai' => 'Anastasya Iswari',
                    'jenis_kelamin' => 'Perempuan',
                    'hp_pegawai' => '081590217843',
                    'alamat_pegawai' => 'Jl. Kamboja No.55',
                    'email_pegawai' => 'iswa@gmail.com',
                    'password' => '$2a$12$fVkcOc7j/0LNY9oDO/W4jOoqje3cikx6TwKJYH9kfqYR5P0yXq1XK', //iswa123
                    'foto_pegawai' => '',
                    'jabatan_pegawai' => '4',
                ]);
    }
}
