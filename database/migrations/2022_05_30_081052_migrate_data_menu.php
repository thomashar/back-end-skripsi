<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrateDataMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_menu');
            $table->integer('harga_menu');
            $table->string('foto_menu');
            $table->string('deskripsi_menu');
            $table->string('jenis_menu');
            $table->boolean('is_Deleted')->default(0);

            $table->foreignId('id_stok')
            ->onDelete('CASCADE')->constrained('stoks');
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
        Schema::dropIfExists('menus');
    }
}
