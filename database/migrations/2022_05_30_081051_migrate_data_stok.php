<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrateDataStok extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stoks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_stok');
            $table->float('jumlah_masuk_stok');
            $table->string('satuan_stok');
            $table->date('tanggal_masuk_stok')->useCurrent();
            $table->float('harga_stok');
            $table->boolean('is_Deleted')->default(0);
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
        Schema::dropIfExists('stoks');
    }
}
