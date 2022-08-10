<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Role;
use Validator;

class RoleController extends Controller
{
    public function get()
    {
        $role = DB::table('roles')
                    ->where('is_Deleted','=','0')
                    ->get();

        if(count($role) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $role
            ],200);
        } //return data semua role dalam bentuk json
        return response([
            'message' => 'Empty',
            'data' => null
        ],404); //return message data role kosong
    }

    public function getOne($id){
        $role = Role::find($id); 
        if(!is_null($role)) {
            return response([
            'message' => 'Retrieve Role Success',
            'data' => $role
            ],200);
        } 

        return response([
            'message' => 'Role Not Found',
            'data' => null
        ],404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama_role' => 'required|max:60|regex:/^[\pL\s]+$/u'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $role = new Role();
        $role->nama_role = $storeData['nama_role'];

        $role->save();

        return response([
            'message' => 'Add Role Succes',
            'data' => $role,
        ]);
    }

    public function update(Request $request)
    {
        $role = Role::find($id);
        if (is_null($role)) {
            return response([
                'message' => 'Role Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_role' => 'max:60|regex:/^[\pL\s]+$/u'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $role->nama_role = $updateData['nama_role'];

        $role->save();

        return response([
            'message' => 'Add Role Succes',
            'data' => $role,
        ]);
    }

    public function delete($id)
    {
        $role = Role::find($id);
        if (is_null($role)) {
            return response([
                'message' => 'Role Not Found',
                'data' => null
            ], 404);
        }

        $role->is_Deleted = 1;

        $role->save();
        return response([
            'message' => 'Delete Role Succes',
            'data' => $role,
        ]);
    }

    public function restore($id)
    {
        $role = Role::find($id);
        if (is_null($role)) {
            return response([
                'message' => 'Role Not Found',
                'data' => null
            ], 404);
        }

        $role->is_Deleted = 0;

        $role->save();
        return response([
            'message' => 'Restore Role Succes',
            'data' => $role,
        ]);
    }
}
