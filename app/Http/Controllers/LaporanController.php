<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use PDF;

class LaporanController extends Controller
{
    public function conditionBulan ($penjualan, $pendapatan)
    {
        if ($penjualan === $pendapatan)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function pendapatanBulanan ($bulan)
    {
        $laporan = DB::table('transaksis')
                    ->select(DB::raw('sum(total_harga) as Pendapatan'))
                    ->whereMonth('tanggal_transaksi', $bulan)
                    ->where('status_pembayaran', '=', '1')
                    ->get();
        
        $pdf = PDF::loadview('pendapatanBulanan',['pendapatan'=>$laporan[0]->Pendapatan]);
        return $pdf->download('laporan-pendapatanBulanan-pdf');
    }

    public function pendapatanTahunan ($tahun)
    {
        $laporan = DB::select(
            "SELECT
            SUM(total_harga) AS Jumlah
            FROM transaksis
            WHERE status_pembayaran = 1
            AND YEAR(tanggal_transaksi) = $tahun
            "
        );
        return $laporan;
    }

    public function penjualanMenuBulan ($bulan)
    {
        $penjualanBulan = DB::select(
            "SELECT
            m.nama_menu,
            m.harga_menu,
            SUM(dp.jumlah_menu) AS Jumlah
            FROM detailpesanans dp join pesanans p on dp.id_pesanan = p.id
                join transaksis t on t.id_pesanan = p.id
                join menus m on dp.id_menu = m.id
            WHERE t.status_pembayaran = 1
            AND MONTH(t.tanggal_transaksi) = $bulan
            GROUP BY m.nama_menu,m.harga_menu
            "
        );

        $laporan = DB::table('transaksis')
                    ->select(DB::raw('sum(total_harga) as Pendapatan'))
                    ->whereMonth('tanggal_transaksi', $bulan)
                    ->where('status_pembayaran', '=', '1')
                    ->get();

        $pdf = PDF::loadview('pendapatanBulanan',['penjualan'=>$penjualanBulan,'pendapatan'=>$laporan[0]->Pendapatan]);
    	return $pdf->download('laporan-pendapatanBulanan-pdf');
    }

    public function penjualanMenuTahun ($tahun)
    {
        $penjualanTahun = DB::select(
            "SELECT
            m.nama_menu,
            m.harga_menu,
            SUM(dp.jumlah_menu) AS Jumlah,
            DATE_FORMAT(t.tanggal_transaksi, '%m') AS Bulan
            FROM detailpesanans dp join pesanans p on dp.id_pesanan = p.id
                join transaksis t on t.id_pesanan = p.id
                join menus m on dp.id_menu = m.id
            WHERE t.status_pembayaran = 1
            AND YEAR(t.tanggal_transaksi) = $tahun
            GROUP BY m.nama_menu, m.harga_menu, Bulan
            "
        );

        $laporan = DB::select(
            "SELECT
            DATE_FORMAT(tanggal_transaksi, '%m') AS Bulan,
            SUM(total_harga) AS Total
            FROM transaksis
            WHERE status_pembayaran = 1
            GROUP BY Bulan
            "
        );
        
        $total = DB::select(
            "SELECT
            SUM(total_harga) AS Jumlah
            FROM transaksis
            WHERE status_pembayaran = 1
            AND YEAR(tanggal_transaksi) = $tahun
            "
        );

        // return $penjualanTahun;
        $pdf = PDF::loadview('pendapatanTahunan',['penjualan'=>$penjualanTahun,'pendapatan'=>$laporan,'jumlah'=>$total[0]->Jumlah]);
    	return $pdf->download('laporan-pendapatanTahunan-pdf');
    }

    // public function cetak_pdf($bulan)
    // {
    // 	$laporan = DB::table('transaksis')
    //                 ->select(DB::raw('sum(total_harga) as Pendapatan'))
    //                 ->whereMonth('tanggal_transaksi', $bulan)
    //                 ->where('status_pembayaran', '=', '1')
    //                 ->get();
 
    // 	$pdf = PDF::loadview('pendapatanBulanan',['pendapatan'=>$laporan[0]->Pendapatan]);
    // 	return $pdf->download('laporan-pendapatanBulanan-pdf');
    // }
}
