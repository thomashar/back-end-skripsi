<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Stok;
use Validator;

class StokController extends Controller
{
    public function get()
    {
        $stok = DB::table('stoks')
                    ->where('is_Deleted','LIKE','0')
                    ->get();
        
        if(count($stok) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $stok
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function getDeleted()
    {
        $stok = DB::table('stoks')
                        ->where('is_Deleted', 'LIKE', '1')
                        ->get();

        if(count($stok) > 0){
            return response([
                'message' => 'Retrieve Deleted Success',
                'data' => $stok
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function getOne($id)
    {
        $stok = Stok::find($id);

        if(!is_null($stok)){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $stok
            ],200);
        }
        return response([
            'message' => 'Stok Not Found',
            'data' => null
        ],404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama_stok' => 'required|max:60',
            'jumlah_masuk_stok' => 'required|numeric',
            'satuan_stok' => 'required',
            'tanggal_masuk_stok' => 'required|date_format:Y-m-d',
            'harga_stok' => 'required|numeric',
            'tanggal_kadaluarsa' => 'required|date_format:Y-m-d'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $stok = new Stok();
        $stok->nama_stok            = $storeData['nama_stok'];
        $stok->jumlah_masuk_stok    = $storeData['jumlah_masuk_stok'];
        $stok->satuan_stok          = $storeData['satuan_stok'];
        $stok->tanggal_masuk_stok   = $storeData['tanggal_masuk_stok'];
        $stok->harga_stok           = $storeData['harga_stok'];
        $stok->tanggal_kadaluarsa   = $storeData['tanggal_kadaluarsa'];
        
        $stok->save();

        return response([
            'message' => 'Add Stok Succes',
            'data' => $stok,
        ],200);
    }

    public function update(Request $request, $id)
    {
        $stok = Stok::find($id);
        if (is_null($stok)) {
            return response([
                'message' => 'Stok Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_stok' => 'required|max:60',
            'jumlah_masuk_stok' => 'required|numeric',
            'satuan_stok' => 'required',
            'tanggal_masuk_stok' => 'required|date_format:Y-m-d',
            'harga_stok' => 'required|numeric',
            'tanggal_kadaluarsa' => 'required|date_format:Y-m-d'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $stok->nama_stok            = $updateData['nama_stok'];
        $stok->jumlah_masuk_stok    = $updateData['jumlah_masuk_stok'];
        $stok->satuan_stok          = $updateData['satuan_stok'];
        $stok->tanggal_masuk_stok   = $updateData['tanggal_masuk_stok'];
        $stok->harga_stok           = $updateData['harga_stok'];
        $stok->tanggal_kadaluarsa   = $updateData['tanggal_kadaluarsa'];

        $stok->save();
        return response([
            'message' => 'Update Stok Success',
            'data' => $stok,
        ],200);
    }

    public function delete($id)
    {
        $stok = Stok::find($id);
        if (is_null($stok)) {
            return response([
                'message' => 'Stok Not Found',
                'data' => null
            ], 404);
        }

        $stok->is_Deleted = 1;

        $stok->save();
        return response([
            'message' => 'Delete Stok Succes',
            'data' => $stok,
        ],200);
    }

    public function restore($id)
    {
        $stok = Stok::find($id);
        if (is_null($stok)) {
            return response([
                'message' => 'Stok Not Found',
                'data' => null
            ], 404);
        }

        $stok->is_Deleted = 0;

        $stok->save();
        return response([
            'message' => 'Restore Stok Succes',
            'data' => $stok,
        ],200);
    }
}
