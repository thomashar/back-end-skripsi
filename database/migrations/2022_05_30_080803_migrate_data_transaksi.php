<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrateDataTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->float('total_bayar');
            $table->float('tax');
            $table->timestamp('tanggal_transaksi')->useCurrent();
            $table->boolean('status_pembayaran')->default(0);
            $table->boolean('is_Deleted')->default(0);

            $table->foreignId('id_pegawai')
            ->onDelete('CASCADE')->constrained('pegawais');

            $table->foreignId('id_pembeli')
            ->onDelete('CASCADE')->constrained('pembelis');

            $table->foreignId('id_pesanan')
            ->onDelete('CASCADE')->constrained('pesanans');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
