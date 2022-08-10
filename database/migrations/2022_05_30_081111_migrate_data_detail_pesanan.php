<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrateDataDetailPesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailPesanans', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_menu');
            $table->float('subtotal');
            $table->boolean('is_Deleted')->default(0);

            $table->foreignId('id_pesanan')
            ->onDelete('CASCADE')->constrained('pesanans');

            $table->foreignId('id_menu')
            ->onDelete('CASCADE')->constrained('menus');

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
        Schema::dropIfExists('detailPesanans');
    }

}
