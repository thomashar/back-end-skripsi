<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\DetailPesanan;
use App\Models\Pesanan;
use Validator;
use GuzzleHttp\Client;

class DetailPesananController extends Controller
{
    public function getAll()
    {
        $detailPesanan = DB::table('detailpesanans')
                            ->join('pesanans', 'detailpesanans.id_pesanan', '=', 'pesanans.id')
                            ->join('menus', 'detailpesanans.id_menu', '=', 'menu.id')
                            ->where('detailpesanans.is_Deleted','LIKE','0')
                            ->get([
                                'pesanans.*',
                                'detailpesanans.*',
                                'menus.nama_menu',
                                'menus.harga_menu'
                            ]);
    
        if(count($detailPesanan) > 0){
            return response([
                'message' => 'Retrieve Detail Pesanan Success',
                'data' => $detailPesanan
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function getOne($id)
    {
        $detailPesanan = DB::table('detailpesanans')
                            ->join('pesanans', 'detailpesanans.id_pesanan', '=', 'pesanans.id')
                            ->join('menus', 'detailpesanans.id_menu', '=', 'menu.id')
                            ->where('detailpesanans.is_Deleted','=','0')
                            ->where('detailpesanans.id', '=', $id)
                            ->get([
                                'pesanans.*',
                                'detailpesanans.*',
                                'menus.nama_menu',
                                'menus.harga_menu'
                            ]);

        if(!is_null($detailPesanan)){
            return response([
                'message' => 'Retrieve Detail Pesanan Success',
                'data' => $detailPesanan
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function getDetailPesanan ($id_pesanan)
    {    
        $detailPesanan = DB::table('detailpesanans')
                            ->join('pesanans', 'detailpesanans.id_pesanan', '=', 'pesanans.id')
                            ->join('menus', 'detailpesanans.id_menu', '=', 'menu.id')
                            ->where('detailpesanans.is_Deleted','=', $id_pesanan)
                            ->get([
                                'pesanans.*',
                                'detailpesanans.*',
                                'menus.nama_menu',
                                'menus.harga_menu'
                            ]);

        $hasil = json_encode($detailPesanan, true);
        $hasil['method']=$method;

        return response([
            'message' => 'Retrive Product Success',
            'data' => $hasil
        ], 200);
    }

    public function store(Request $request)
    {       
        $hasil = json_decode($request->data, true);

        for ($x = 0; $x < sizeof($hasil); $x+=3) {
    
            $detailPesanan = new DetailPesanan();
            $detailPesanan->jumlah_menu    = $hasil[$x];
            $detailPesanan->id_pesanan     = $hasil[$x+1];
            $detailPesanan->id_menu        = $hasil[$x+2];
            
            $detailPesanan->save();
        }

        return response([
            'message' => 'Add Detail Pesanan Success',
            'data' => null,
        ],200);
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

        $detailPesanan->jumlah_menu    = $updateData['jumlah_menu'];

        $detailPesanan->save();
        return response([
            'message' => 'Update Detail Pesanan Success',
            'data' => $detailPesanan,
        ],200);
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
        ],200);
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
        ],200);
    }
}
