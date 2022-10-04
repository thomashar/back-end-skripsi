<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use Validator;

class MenuController extends Controller
{
    public function getAll()
    {
        $menu = DB::table('menus')->get();

        if(count($menu) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $menu
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function getNotDeleted()
    {
        $menu = DB::table('menus')
                    ->where('is_Deleted', 'LIKE', '0')
                    ->get();

        if(count($menu) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $menu
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function getDeleted()
    {
        $menu = DB::table('menus')
                        ->where('is_Deleted', 'LIKE', '1')
                        ->get();

        if(count($menu) > 0){
            return response([
                'message' => 'Retrieve Deleted Success',
                'data' => $menu
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function getByName($name)
    {
        $menu = DB::table('menus')
                    ->where('nama_menu', 'LIKE', '%'.$name.'%')            
                    ->get(); 
    
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

    public function getOne($id)
    {
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
            'foto_menu' => 'nullable|file|image',
            'deskripsi_menu' => 'required',
            'jenis_menu' => 'required'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        if (!is_null($request->file('foto_menu'))) {
            $file          = $request->file('foto_menu');
            $nama_file     = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = 'menu_picture';
            $file->move($tujuan_upload, $nama_file);
        } else {
            $nama_file = 'foto_menu.png';
        }

        $menu = new Menu();
        $menu->nama_menu        = $storeData['nama_menu'];
        $menu->harga_menu       = $storeData['harga_menu'];
        $menu->foto_menu        = $nama_file;
        $menu->deskripsi_menu   = $storeData['deskripsi_menu'];
        $menu->jenis_menu       = $storeData['jenis_menu'];

        $menu->save();

        return response([
            'message' => 'Add Menu Succes',
            'data' => $menu,
        ],200);
    }

    public function saveFoto(Request $request, $id) 
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
            'foto_menu' => 'nullable|file'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        if (!is_null($request->file('foto_menu'))) {
            $file          = $request->file('foto_menu');
            // $file          = str_replace(' ', '_', $file);
            $tujuan_upload = 'menu_picture';

            $nama_file     = $tujuan_upload . '/' . time() . "_" . $file->getClientOriginalName();
            
            $file->move($tujuan_upload, $nama_file);

            $menu->foto_menu     = $nama_file;
        }

        $menu->save();
        // $storeData['foto_menu'] = $nama_file;
        // $menu = Menu::create($storeData);

        return response([
            'message' => 'Update Menu Success',
            'data' => $menu,
        ],200);
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
            'foto_menu' => 'nullable',
            'deskripsi_menu' => '',
            'jenis_menu' => ''
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        if (!is_null($request->file('foto_menu'))) {
            $file          = $request->file('foto_menu');
            $nama_file     = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = 'menu_picture';
            $file->move($tujuan_upload, $nama_file);

            $menu->foto_menu     = $nama_file;
        }

        $menu->nama_menu        = $updateData['nama_role'];
        $menu->harga_menu       = $updateData['harga_menu'];
        $menu->foto_menu        = $nama_file;
        $menu->deskripsi_menu   = $updateData['deskripsi_menu'];
        $menu->jenis_menu       = $updateData['jenis_menu'];

        $menu->save();

        return response([
            'message' => 'Add Menu Succes',
            'data' => $menu,
        ],200);
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
        ],200);
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
        ],200);
    }
}
