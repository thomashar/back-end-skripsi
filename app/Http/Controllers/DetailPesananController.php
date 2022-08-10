<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\DetailPesanan;
use Validator;

class DetailPesananController extends Controller
{
    public function getAll()
    {
        $detailPesanan = DB::table('detailpesanans')
                            ->where('is_Deleted','LIKE','0')
                            ->get();
    
        return response([
            'message' => 'Retrive All Success',
            'data' => $detailPesanan
        ]);
    }

    public function getOne($id)
    {
        $detailPesanan = DetailPesanan::find($id);

        return response([
            'message' => 'Retrive Detail Pesanan Success',
            'data' => $detailPesanan
        ]);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'jumlah_menu' => 'required|numeric',
            'subtotal' => 'required|numeric',
            'id_pesanan' => 'required',
            'id_menu' => 'required'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $detailPesanan = new DetailPesanan();
        $detailPesanan->jumlah_menu    = $storeData['jumlah_menu'];
        $detailPesanan->subtotal       = $storeData['subtotal'];
        $detailPesanan->id_pesanan     = $storeData['id_pesanan'];
        $detailPesanan->id_menu        = $storeData['id_menu'];
        
        $detailPesanan->save();

        return response([
            'message' => 'Add Detail Pesanan Succes',
            'data' => $detailPesanan,
        ]);
    }

    public function update(Request $request, $id)
    {
        $detailPesanan = DetailPesanan::find($id);
        if (is_null($detailPesanan)) {
            return response([
                'message' => 'Detail Pesanan Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'jumlah_menu' => 'required|numeric',
            'subtotal' => 'required|numeric',
            'id_pesanan' => 'required',
            'id_menu' => 'required'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $detailPesanan->jumlah_menu    = $updateData['jumlah_menu'];
        $detailPesanan->subtotal       = $updateData['subtotal'];
        $detailPesanan->id_pesanan     = $updateData['id_pesanan'];
        $detailPesanan->id_menu        = $updateData['id_menu'];

        $detailPesanan->save();
        return response([
            'message' => 'Update Detail Pesanan Success',
            'data' => $detailPesanan,
        ]);
    }

    public function delete($id)
    {
        $detailPesanan = DetailPesanan::find($id);
        if (is_null($detailPesanan)) {
            return response([
                'message' => 'Detail Pesanan Not Found',
                'data' => null
            ], 404);
        }

        $detailPesanan->is_Deleted = 1;

        $detailPesanan->save();
        return response([
            'message' => 'Delete Detail Pesanan Succes',
            'data' => $detailPesanan,
        ]);
    }

    public function restore($id)
    {
        $detailPesanan = DetailPesanan::find($id);
        if (is_null($detailPesanan)) {
            return response([
                'message' => 'Detail Pesanan Not Found',
                'data' => null
            ], 404);
        }

        $detailPesanan->is_Deleted = 0;

        $detailPesanan->save();
        return response([
            'message' => 'Restore Detail Pesanan Succes',
            'data' => $detailPesanan,
        ]);
    }
}
