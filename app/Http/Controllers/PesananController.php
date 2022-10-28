<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Pesanan;
use Validator;

class PesananController extends Controller
{
    public function getAll()
    {
        $pesanan = DB::table('pesanans')
                        ->join('detailpesanans', 'pesanans.id', '=', 'detailpesanans.id_pesanan')
                        ->join('menus', 'detailpesanans.id_menu', '=', 'menus.id')
                        ->where('pesanans.is_Deleted','LIKE','0')
                        ->get([
                            'pesanans.*',
                            'detailpesanans.*',
                            'menus.nama_menu',
                            'menus.harga_menu'
                        ]);
        return response([
            'message' => 'Retrive All Success',
            'data' => $pesanan
        ],200);
    }

    public function getOne($id)
    {
        $pesanan = DB::table('pesanans')
                        ->join('detailpesanans', 'pesanans.id', '=', 'detailpesanans.id_pesanan')
                        ->join('menus', 'detailpesanans.id_menu', '=', 'menus.id')
                        ->where('pesanans.is_Deleted','LIKE',$id)
                        ->get([
                            'pesanans.*',
                            'detailpesanans.*',
                            'menus.nama_menu',
                            'menus.harga_menu'
                        ]);
        if(!is_null($pesanan)){
            return response([
                'message' => 'Retrieve Pesanan Success',
                'data' => $pesanan
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function getByName($name)
    {
        $pesanan = DB::table('pesanans')
                        ->join('detailpesanans', 'pesanans.id', '=', 'detailpesanans.id_pesanan')
                        ->join('menus', 'detailpesanans.id_menu', '=', 'menus.id')
                        ->where('pesanans.nama_pembeli','LIKE','%'.$name.'%')
                        ->get([
                            'pesanans.*',
                            'detailpesanans.*',
                            'menus.nama_menu',
                            'menus.harga_menu'
                        ]);
        if(!is_null($pesanan)){
            return response([
                'message' => 'Retrieve Pesanan Success',
                'data' => $pesanan
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
            'tanggal_pesanan' => 'required|date_format:Y-m-d',
            'nama_pembeli' => 'required'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $pesanan = new Pesanan();
        $pesanan->tanggal_pesanan      = $storeData['tanggal_pesanan'];
        $pesanan->nama_pembeli         = $storeData['nama_pembeli'];
        
        $pesanan->save();

        return response([
            'message' => 'Add Pesanan Succes',
            'data' => $pesanan,
        ],200);
    }

    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::find($id);
        if (is_null($pesanan)) {
            return response([
                'message' => 'Pesanan Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'tanggal_pesanan' => 'date_format:Y-m-d',
            'nama_pembeli' => ''
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $pesanan->tanggal_pesanan     = $updateData['tanggal_pesanan'];
        $pesanan->nama_pembeli        = $updateData['nama_pembeli'];

        $pesanan->save();
        return response([
            'message' => 'Update Pesanan Success',
            'data' => $pesanan,
        ],200);
    }

    public function delete($id)
    {
        $pesanan = Pesanan::find($id);
        if (is_null($pesanan)) {
            return response([
                'message' => 'Pesanan Not Found',
                'data' => null
            ], 404);
        }

        $pesanan->is_Deleted = 1;

        $pesanan->save();
        return response([
            'message' => 'Delete Pesanan Succes',
            'data' => $pesanan,
        ],200);
    }

    public function restore($id)
    {
        $pesanan = Pesanan::find($id);
        if (is_null($pesanan)) {
            return response([
                'message' => 'Pesanan Not Found',
                'data' => null
            ], 404);
        }

        $pesanan->is_Deleted = 0;

        $pesanan->save();
        return response([
            'message' => 'Restore Pesanan Succes',
            'data' => $pesanan,
        ],200);
    }
}
