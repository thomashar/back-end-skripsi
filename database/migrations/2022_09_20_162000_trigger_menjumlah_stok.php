<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TriggerMenjumlahStok extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER menjumlah_stok
        AFTER INSERT ON historystoks
            FOR EACH ROW            
            BEGIN
                UPDATE menus
                SET total_porsi = (SELECT ROUND((h.jumlah_stok/r.jumlah_resep), 0)
                                    FROM historystoks h
                                    JOIN reseps r
                                    ON h.id = r.id_historystok
                                    JOIN menus m
                                    ON r.id_menu = m.id
                                    WHERE r.id_menu = m.id);
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::unprepared('DROP TRIGGER "menjumlah_stok"');
    }
}
