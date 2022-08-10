<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Pembeli;
use Validator;

class PembeliController extends Controller
{
    public function get()
    {
        $pembeli = DB::table('pembelis')
                        ->where('is_Deleted','LIKE','0')
                        ->get();

        return response([
            'message' => 'Retrive All Success',
            'data' => $pembeli
        ]);
    }

    public function getAll()
    {
        $pembeli = Pembeli::get();

        return response([
            'message' => 'Retrive All Success',
           'data' => $pembeli
        ]);
    }

    public function getOne($id)
    {
        $pembeli = Pembeli::find($id);

        return response([
            'message' => 'Retrive Pembeli Success',
            'data' => $pembeli
        ]);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama_pembeli' => 'required|max:60|unique:pembelis',
            'email_pembeli' => 'nullable|email:rfc,dns',
        ]);

        if ($validate->fails()){
            return response(['message' => $validate->errors()], 400);
        }

        $pembeli = new Pembeli();
        $pembeli->nama_pembeli     = $storeData['nama_pembeli'];
        $pembeli->email_pembeli    = $storeData['email_pembeli'];

        $pembeli->save();

        return response([
            'message' => 'Add Pembeli Succes',
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
            'nama_pembeli' => ['max:60', Rule::unique('pembelis')->ignore($pembeli)],
            'email_pembeli' => 'nullable|email:rfc,dns'
        ]);

        if ($validate->fails()){
            return response(['message' => $validate->errors()], 400);
        }

        $pembeli->nama_pembeli    = $updateData['nama_pembeli'];
        $pembeli->email_pembeli   = $updateData['email_pembeli'];

        $pembeli->save();
        return response([
            'message' => 'Update Pembeli Succes',
            'data' => $pembeli,
        ]);
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
        ]);
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
        ]);
    }

    public function destroy($id)
    {
        $pembeli = Pembeli::find($id);

        $pembeli->delete();
        return response([
            'message' => 'Delete Pembeli Succes',
            'data' => $pembeli,
        ]);
    }

}
