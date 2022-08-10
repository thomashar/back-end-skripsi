<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrateDataPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pegawai');
            $table->boolean('jenis_kelamin');
            $table->integer('hp_pegawai');
            $table->string('alamat_pegawai');
            $table->string('email_pegawai');
            $table->string('password');
            $table->boolean('status_pegawai')->default(1);
            $table->string('foto_pegawai');
            $table->boolean('is_Deleted')->default(0);

            $table->unsignedBigInteger('id_role');
            $table->foreign('id_role')
            ->references('id')->on('roles');
            
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
        Schema::dropIfExists('pegawais');
    }
}
