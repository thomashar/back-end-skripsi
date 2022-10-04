<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrateDataHistorystok extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historyStoks', function (Blueprint $table) {
            $table->id();
            
            $table->string('nama_stok');
            $table->timestamp('tanggal_stok');
            $table->float('jumlah_stok');
            $table->string('satuan_stok');
            $table->boolean('status_stok');
            $table->float('harga_stok');
            $table->boolean('is_Deleted')->default(0);

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
        Schema::dropIfExists('historyStoks');
    }
}
