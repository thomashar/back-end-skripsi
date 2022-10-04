<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\HistoryStok;
use App\Models\Menu;
use Validator;

class HistoryStokController extends Controller
{
    public function get()
    {
        $historyStok = DB::table('historyStoks')
                        ->orderBy('historyStoks.tanggal_stok', 'asc')
                        ->where('is_Deleted', 'LIKE', '0')
                        ->get();
        
        if(count($historyStok) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $historyStok
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function getDeleted()
    {
        $historyStok = DB::table('historyStoks')
                        ->where('is_Deleted', 'LIKE', '1')
                        ->get();

        if(count($historyStok) > 0){
            return response([
                'message' => 'Retrieve Deleted Success',
                'data' => $historyStok
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function getOne($id)
    {
        $historyStok = HistoryStok::find($id);

        if(!is_null($historyStok)){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $historyStok
            ],200);
        }
        return response([
            'message' => 'Stok Not Found',
            'data' => null
        ],404);
    }

    public function tambahTotalStok(Request $request,$nama)
    {
        $menu = Menu::where('nama_menu', 'LIKE', $nama)
                    ->get();
        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'jumlah_stok' => 'required|numeric',
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $temp = $updateData['jumlah_stok'];
        $tempMenu = $menu->total_stok;
        $menu->total_stok = $temp + $tempMenu;

        $menu->save();
        return response([
            'message' => 'Add Stok Succes',
            'data' => $menu,
        ],200);
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
            'nama_stok' => 'required|max:60',
            'tanggal_stok' => 'required|date_format:Y-m-d',
            'jumlah_stok' => 'required|numeric',
            'satuan_stok' => 'required',
            'status_stok' => 'required',
            'harga_stok' => 'required|numeric',
            'id_resep' => 'required'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $historyStok = new HistoryStok();
        $historyStok->nama_stok        = $storeData['nama_stok'];
        $historyStok->jumlah_stok      = $storeData['jumlah_stok'];
        $historyStok->satuan_stok      = $storeData['satuan_stok'];
        $historyStok->tanggal_stok     = $storeData['tanggal_stok'];
        $historyStok->harga_stok       = $storeData['harga_stok'];
        $historyStok->status_stok      = $storeData['status_stok'];
        $historyStok->id_resep         = $storeData['id_resep'];
        
        $historyStok->save();

        return response([
            'message' => 'Add Stok Succes',
            'data' => $historyStok,
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
        $historyStok = HistoryStok::find($id);
        if (is_null($historyStok)) {
            return response([
                'message' => 'Stok Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_stok' => 'max:60',
            'tanggal_stok' => 'date_format:Y-m-d',
            'jumlah_stok' => 'numeric',
            'satuan_stok' => '',
            'status_stok' => '',
            'harga_stok' => 'numeric',
            'id_resep' => ''
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $historyStok->nama_stok        = $updateData['nama_stok'];
        $historyStok->jumlah_stok      = $updateData['jumlah_stok'];
        $historyStok->satuan_stok      = $updateData['satuan_stok'];
        $historyStok->tanggal_stok     = $updateData['tanggal_stok'];
        $historyStok->harga_stok       = $updateData['harga_stok'];
        $historyStok->status_stok      = $updateData['status_stok'];
        $historyStok->id_resep         = $updateData['id_resep'];

        $historyStok->save();
        return response([
            'message' => 'Update Stok Success',
            'data' => $historyStok,
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
        $historyStok = HistoryStok::find($id);
        if (is_null($historyStok)) {
            return response([
                'message' => 'Stok Not Found',
                'data' => null
            ], 404);
        }

        $historyStok->is_Deleted = 1;

        $historyStok->save();
        return response([
            'message' => 'Delete Stok Succes',
            'data' => $historyStok,
        ],200);
    }

    public function restore($id)
    {
        $historyStok = HistoryStok::find($id);
        if (is_null($historyStok)) {
            return response([
                'message' => 'Stok Not Found',
                'data' => null
            ], 404);
        }

        $historyStok->is_Deleted = 0;

        $historyStok->save();
        return response([
            'message' => 'Restore Stok Succes',
            'data' => $historyStok,
        ],200);
    }    
}
