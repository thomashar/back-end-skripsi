<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Menu;
use Validator;

class MenuController extends Controller
{
    public function get()
    {
        $menu = DB::table('menus')
                    ->where('is_Deleted','LIKE','0')
                    ->get();

        return response([
            'message' => 'Retrive All Success',
            'data' => $menu
        ]);
    }

    public function getOne($id){
        $menu = Menu::find($id); 
        if(!is_null($menu)) {
            return response([
            'message' => 'Retrieve Menu Success',
            'data' => $menu
            ],200);
        } 

        return response([
            'message' => 'Menu Not Found',
            'data' => null
        ],404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama_menu' => 'required|max:60',
            'harga_menu' => 'required|numeric',
            'deskripsi_menu' => 'required',
            'jenis_menu' => 'required',
            'id_stok' => 'required'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        if (!is_null($request->file('foto_menu'))) {
            $file          = $request->file('foto_menu');
            $nama_file     = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = 'data_menu';
            $file->move($tujuan_upload, $nama_file);
        } else {
            $nama_file = 'foto_menu.png';
        }

        $menu = new Menu();
        $menu->nama_menu        = $storeData['nama_menu'];
        $menu->harga_menu       = $storeData['harga_menu'];
        $menu->deskripsi_menu   = $storeData['deskripsi_menu'];
        $menu->jenis_menu       = $storeData['jenis_menu'];
        $menu->id_stok          = $storeData['id_stok'];

        $menu->save();

        return response([
            'message' => 'Add Menu Succes',
            'data' => $menu,
        ]);
    }

    public function update(Request $request)
    {
        $menu = Menu::find($id);
        if (is_null($menu)) {
            return response([
                'message' => 'Menu Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_role' => 'max:60',
            'harga_menu' => 'numeric',
            'deskripsi_menu' => '',
            'jenis_menu' => '',
            'id_stok' => ''
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        if (!is_null($request->file('foto_menu'))) {
            $file          = $request->file('foto_menu');
            $nama_file     = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = 'data_menu';
            $file->move($tujuan_upload, $nama_file);

            $menu->foto_menu     = $nama_file;
        }

        $menu->nama_menu        = $updateData['nama_role'];
        $menu->harga_menu       = $updateData['harga_menu'];
        $menu->deskripsi_menu   = $updateData['deskripsi_menu'];
        $menu->jenis_menu       = $updateData['jenis_menu'];
        $menu->id_stok          = $updateData['id_stok'];

        $menu->save();

        return response([
            'message' => 'Add Menu Succes',
            'data' => $menu,
        ]);
    }

    public function delete($id)
    {
        $menu = Menu::find($id);
        if (is_null($menu)) {
            return response([
                'message' => 'Menu Not Found',
                'data' => null
            ], 404);
        }

        $menu->is_Deleted = 1;

        $menu->save();
        return response([
            'message' => 'Delete Menu Succes',
            'data' => $menu,
        ]);
    }

    public function restore($id)
    {
        $menu = Menu::find($id);
        if (is_null($menu)) {
            return response([
                'message' => 'Menu Not Found',
                'data' => null
            ], 404);
        }

        $menu->is_Deleted = 0;

        $menu->save();
        return response([
            'message' => 'Restore Menu Succes',
            'data' => $menu,
        ]);
    }
}
