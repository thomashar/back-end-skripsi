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

class TransaksiController extends Controller
{
    public function getAll()
    {
        $transaksi = DB::table('transaksis')
                        ->join('pegawais', 'transaksis.id_pegawai', '=', 'pegawais.id')
                        ->join('pembelis', 'transaksis.id_pembeli', '=', 'pembelis.id')
                        ->join('pesanans', 'transaksis.id_pesanan', '=', 'pesanans.id')
                        ->join('detailpesanans', 'pesanans.id', '=', 'detailpesanans.id_pesanan')
                        ->join('menus', 'detailpesanans.id_menu', '=', 'menus.id')
                        ->orderBy('transaksis.status_pembayaran', 'asc')
                        ->get([
                            'transaksis.*',
                            'menus.nama_menu',
                            'menus.harga_menu',
                            'pembelis.nama_pembeli',
                            'pegawais.nama_pegawai',
                            'detailpesanans.*',
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
                        ->join('pegawais', 'transaksis.id_pegawai', '=', 'pegawais.id')
                        ->join('pembelis', 'transaksis.id_pembeli', '=', 'pembelis.id')
                        ->join('pesanans', 'transaksis.id_pesanan', '=', 'pesanans.id')
                        ->join('detailpesanans', 'pesanans.id', '=', 'detailpesanans.id_pesanan')
                        ->join('menus', 'detailpesanans.id_menu', '=', 'menus.id')
                        ->orderBy('transaksis.status_pembayaran', 'LIKE', '0')
                        ->where('pembelis.nama_pembeli', 'LIKE', '%'.$nama.'%')
                        ->get([
                            'transaksis.*',
                            'menus.nama_menu',
                            'menus.harga_menu',
                            'pembelis.nama_pembeli',
                            'pegawais.nama_pegawai',
                            'detailpesanans.*',
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
            'tax' => 'required|numeric',
            'tanggal_transaksi' => 'required|date_format:Y-m-d',
            'status_pembayaran' => 'required',
            'id_pegawai' => 'required',
            'id_pembeli' => 'required',
            'id_pesanan' => 'required'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $transaksi = new Transaksi();
        $transaksi->tax                 = $storeData['tax'];
        $transaksi->tanggal_transaksi   = $storeData['tanggal_transaksi'];
        $transaksi->status_pembayaran   = $storeData['status_pembayaran'];
        $transaksi->id_pegawai          = $storeData['id_pegawai'];
        $transaksi->id_pembeli          = $storeData['id_pembeli'];
        $transaksi->id_pesanan          = $storeData['id_pesanan'];
        
        $transaksi->save();

        return response([
            'message' => 'Add Transaksi Succes',
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
            'tax' => 'numeric',
            'tanggal_transaksi' => 'date_format:Y-m-d',
            'status_pembayaran' => '',
            'id_pegawai' => '',
            'id_pembeli' => '',
            'id_pesanan' => ''
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $transaksi->tax                 = $updateData['tax'];
        $transaksi->tanggal_transaksi   = $updateData['tanggal_transaksi'];
        $transaksi->status_pembayaran   = $updateData['status_pembayaran'];
        $transaksi->id_pegawai          = $updateData['id_pegawai'];
        $transaksi->id_pembeli          = $updateData['id_pembeli'];
        $transaksi->id_pesanan          = $updateData['id_pesanan'];

        $transaksi->save();
        return response([
            'message' => 'Update Transaksi Success',
            'data' => $transaksi,
        ],200);
    }

    public function updateStatus(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        if (is_null($transaksi)) {
            return response([
                'message' => 'Transaksi Not Found',
                'data' => null
            ], 404);
        }

        if ($transaksi->status_pembayaran == 0) {
            $transaksi->status_pembayaran = 1;
        }

        $transaksi->save();
        return response([
            'message' => 'Update Status Transaksi Success',
            'data' => $transaksi,
        ],200);
    }

    public function sendMail($email,$body)
    {
        try{
            $detail = [
                'body' => $body,
            ];
            Mail::to($email)->send(new TransaksiMail($email));
        }catch(Exception $e){
            return redirect()->route('Transaksi.id')->with('success','but email cannot be sent');
        }
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
