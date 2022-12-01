<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\Pembeli;
use App\Models\Pesanan;
use Validator;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function getAll()
    {
        $transaksi = DB::table('transaksis')
                        ->join('pesanans', 'transaksis.id_pesanan', '=', 'pesanans.id')
                        ->orderBy('transaksis.status_pembayaran', 'asc')
                        ->get([
                            'transaksis.*',
                            'pesanans.*'
                        ]);
        return response([
            'message' => 'Retrieve All Success',
            'data' => $transaksi
        ],200);
    }

    public function getByName($nama)
    {
        $transaksi = DB::table('transaksis')
                        ->join('pesanans', 'transaksis.id_pesanan', '=', 'pesanans.id')
                        ->join('detailpesanans', 'pesanans.id', '=', 'detailpesanans.id_pesanan')
                        ->join('menus', 'detailpesanans.id_menu', '=', 'menus.id')
                        ->orderBy('transaksis.status_pembayaran', 'asc')
                        ->where('pesanans.nama_pembeli', 'LIKE', '%'.$nama.'%')
                        ->get([
                            'transaksis.*',
                            'menus.nama_menu',
                            'menus.harga_menu',
                            'detailpesanans.*',
                            'pesanans.*'
                        ]);
        return response([
            'message' => 'Retrieve All Success',
            'data' => $transaksi
        ],200);
    }

    public function getByTanggalAndIdPesanan($id_pesanan)
    {
        $currentDate = Carbon::now();
        $transaksi = DB::table('transaksis')
                        ->join('pesanans', 'transaksis.id_pesanan', '=', 'pesanans.id')
                        ->orderBy('transaksis.status_pembayaran', 'asc')
                        ->where('transaksis.id_pesanan', 'LIKE', $id_pesanan)
                        ->get([
                            'transaksis.*',
                            'pesanans.*'
                        ]);
        return response([
            'message' => 'Retrieve All Success',
            'data' => $transaksi
        ],200);
    }

    public function getOne($id)
    {
        $transaksi = Transaksi::find($id);

        if(!is_null($transaksi)){
            return response([
                'message' => 'Retrieve Transaksi Success',
                'data' => $transaksi
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'total_harga' => 'required|numeric',
            'id_pesanan' => 'required'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $transaksi = new Transaksi();
        $transaksi->total_harga         = $storeData['total_harga'];
        $transaksi->id_pesanan          = $storeData['id_pesanan'];
        
        $transaksi->save();

        return response([
            'message' => 'Add Transaksi Success',
            'data' => $transaksi,
        ],200);
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        if (is_null($transaksi)) {
            return response([
                'message' => 'Transaksi Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'total_harga' => 'numeric',
            'tanggal_transaksi' => 'date_format:Y-m-d',
            'status_pembayaran' => '',
            'id_pegawai' => '',
            'id_pesanan' => ''
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $transaksi->total_harga         = $updateData['total_harga'];
        $transaksi->tanggal_transaksi   = $updateData['tanggal_transaksi'];
        $transaksi->status_pembayaran   = $updateData['status_pembayaran'];
        $transaksi->id_pegawai          = $updateData['id_pegawai'];
        $transaksi->id_pesanan          = $updateData['id_pesanan'];

        $transaksi->save();
        return response([
            'message' => 'Update Transaksi Success',
            'data' => $transaksi,
        ],200);
    }
    // Property [status_pembayaran] does not exist on this collection instance.

    public function updateStatus($id, $id_pegawai)
    {
        $transaksi = Transaksi::where('id_pesanan', '=', $id)
                                ->first();
        if (is_null($transaksi)) {
            return response([
                'message' => 'Transaksi Not Found',
                'data' => null
            ], 404);
        }

        if ($transaksi->status_pembayaran == 0) {
            $transaksi->status_pembayaran = 1;
            $transaksi->id_pegawai = $id_pegawai;
        }

        $transaksi->save();
        return response([
            'message' => 'Update Status Transaksi Success',
            'data' => $transaksi,
        ],200);
    }   

    public function delete($id)
    {
        $transaksi = Transaksi::find($id);
        if (is_null($transaksi)) {
            return response([
                'message' => 'Transaksi Not Found',
                'data' => null
            ], 404);
        }

        $transaksi->is_Deleted = 1;

        $transaksi->save();
        return response([
            'message' => 'Delete Transaksi Succes',
            'data' => $transaksi,
        ],200);
    }

    public function restore($id)
    {
        $transaksi = Transaksi::find($id);
        if (is_null($transaksi)) {
            return response([
                'message' => 'Transaksi Not Found',
                'data' => null
            ], 404);
        }

        $transaksi->is_Deleted = 0;

        $transaksi->save();
        return response([
            'message' => 'Restore Transaksi Succes',
            'data' => $transaksi,
        ],200);
    }
}
