<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Stok;
use Validator;

class StokController extends Controller
{
    public function get()
    {
        $stok = DB::table('stoks')
                    ->where('is_Deleted','LIKE','0')
                    ->get();
        return response([
            'message' => 'Retrive All Success',
            'data' => $stok
        ]);
    }

    public function getDeleted($is_Deleted)
    {
        $stok = Stok::where('is_Deleted', $is_Deleted)
                          ->where('is_Deleted', 'LIKE', '1')
                          ->get();

        return response([
            'message' => 'Retrive Deleted Success',
            'data' => $stok
        ]);
    }

    public function getOne($id)
    {
        $stok = Stok::find($id);

        return response([
            'message' => 'Retrive Stok Success',
            'data' => $stok
        ]);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama_stok' => 'required|max:60',
            'jumlah_masuk_stok' => 'required|numeric',
            'satuan_stok' => 'required',
            'tanggal_masuk_stok' => 'required|date_format:Y-m-d',
            'harga_stok' => 'required|numeric'
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
        
        $stok->save();

        return response([
            'message' => 'Add Stok Succes',
            'data' => $stok,
        ]);
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
            'harga_stok' => 'required|numeric'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $stok->nama_stok            = $updateData['nama_stok'];
        $stok->jumlah_masuk_stok    = $updateData['jumlah_masuk_stok'];
        $stok->satuan_stok          = $updateData['satuan_stok'];
        $stok->tanggal_masuk_stok   = $updateData['tanggal_masuk_stok'];
        $stok->harga_stok           = $updateData['harga_stok'];

        $stok->save();
        return response([
            'message' => 'Update Stok Success',
            'data' => $stok,
        ]);
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
        ]);
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
        ]);
    }
}
