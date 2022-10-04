<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Pembeli;
use Validator;

class PembeliController extends Controller
{
    public function get()
    {
        $pembeli = DB::table('pembelis')
                        ->where('is_Deleted','LIKE','0')
                        ->get();

        if(count($pembeli) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pembeli
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function getDeleted()
    {
        $pembeli = DB::table('pembelis')
                        ->where('is_Deleted', 'LIKE', '1')
                        ->get();

        if(count($pembeli) > 0){
            return response([
                'message' => 'Retrieve Deleted Success',
                'data' => $pembeli
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function getAll()
    {
        $pembeli = Pembeli::get();

        if(count($pembeli) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pembeli
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function getOne($id)
    {
        $pembeli = Pembeli::find($id);

        if(!is_null($pembeli)){
            return response([
                'message' => 'Retrieve Pembeli Success',
                'data' => $pembeli
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
            'nama_pembeli' => 'required|max:60|unique:pembelis'
        ]);

        if ($validate->fails()){
            return response(['message' => $validate->errors()], 400);
        }

        $pembeli = new Pembeli();
        $pembeli->nama_pembeli     = $storeData['nama_pembeli'];

        $pembeli->save();

        return response([
            'message' => 'Add Pembeli Success',
            'data' => $pembeli
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $pembeli = Pembeli::find($id);
        if (is_null($pembeli)) {
            return response([
                'message' => 'Pembeli Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_pembeli' => ['max:60', Rule::unique('pembelis')->ignore($pembeli)]
        ]);

        if ($validate->fails()){
            return response(['message' => $validate->errors()], 400);
        }

        $pembeli->nama_pembeli    = $updateData['nama_pembeli'];

        $pembeli->save();
        return response([
            'message' => 'Update Pembeli Success',
            'data' => $pembeli,
        ],200);
    }

    public function delete($id)
    {
        $pembeli = Pembeli::find($id);
        if (is_null($pembeli)) {
            return response([
                'message' => 'Pembeli Not Found',
                'data' => null
            ], 404);
        }

        $pembeli->is_Deleted = 1;

        $pembeli->save();
        return response([
            'message' => 'Delete Pembeli Succes',
            'data' => $pembeli,
        ],200);
    }

    public function restore($id)
    {
        $pembeli = Pembeli::find($id);
        if (is_null($pembeli)) {
            return response([
                'message' => 'Pembeli Not Found',
                'data' => null
            ], 404);
        }

        $pembeli->is_Deleted = 0;

        $pembeli->save();
        return response([
            'message' => 'Restore Pembeli Succes',
            'data' => $pembeli,
        ],200);
    }

    public function destroy($id)
    {
        $pembeli = Pembeli::find($id);

        $pembeli->delete();
        return response([
            'message' => 'Delete Pembeli Succes',
            'data' => $pembeli,
        ],200);
    }

}
