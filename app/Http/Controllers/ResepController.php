<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Resep;
use Validator;

class ResepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $resep = DB::table('reseps')
                    ->leftjoin('menus', 'reseps.id_menu', '=', 'menus.id')
                    ->orderBy('menus.id', 'asc')
                    ->get([
                        'reseps.*',
                        'menus.nama_menu'
                    ]);

        if(count($resep) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $resep
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function getOne($id)
    {
        $resep = Resep::find($id); 
    
        if(!is_null($resep)) {
            return response([
            'message' => 'Retrieve Resep Success',
            'data' => $resep
            ],200);
        } 

        return response([
            'message' => 'Resep Not Found',
            'data' => null
        ],404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'jumlah_resep' => 'required|numeric'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $resep = new Resep();
        $resep->jumlah_resep = $storeData['jumlah_resep'];
        
        $resep->save();

        return response([
            'message' => 'Add Resep Succes',
            'data' => $resep,
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $resep = Resep::find($id);
        if (is_null($resep)) {
            return response([
                'message' => 'Resep Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'jumlah_resep' => 'required|numeric'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $resep->jumlah_resep = $updateData['jumlah_resep'];

        $resep->save();
        return response([
            'message' => 'Update Resep Success',
            'data' => $resep,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
