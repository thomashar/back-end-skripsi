<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Pegawai;
use Validator;

class PegawaiController extends Controller
{
    public function getAll()
    {
        $pegawai = Pegawai::where('is_Deleted','LIKE', '0')
                        ->get();

        if(count($pegawai) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pegawai
            ],200);
        } //return data semua pegawai dalam bentuk json
        return response([
            'message' => 'Empty',
            'data' => null
        ],404); //return message data pegawai kosong
    }

    public function getPegawaiMendaftar()
    {
        $pegawai = Pegawai::where('status_pegawai','LIKE', '2')
                        ->get();

        if(count($pegawai) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pegawai
            ],200);
        } //return data semua pegawai dalam bentuk json
        return response([
            'message' => 'Empty',
            'data' => null
        ],404); //return message data pegawai kosong
    }

    // public function get($status_pegawai)
    // {
    //     $pegawai = Pegawai::where('status_pegawai', $status_pegawai)
    //                       ->where('id_role', 'NOT LIKE', '1')
    //                       ->get();

    //     return response([
    //         'message' => 'Retrive All Success',
    //         'data' => $pegawai
    //     ]);
    // }

    public function getDeleted()
    {
        $pegawai = DB::table('pegawais')
                        ->where('is_Deleted', 'LIKE', '1')
                        ->get();

        if(count($pegawai) > 0){
            return response([
                'message' => 'Retrieve Deleted Success',
                'data' => $pegawai
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function getOne($id)
    {
        $pegawai = Pegawai::find($id);

        if(!is_null($pegawai)){
            return response([
                'message' => 'Retrieve Pegawai Success',
                'data' => $pegawai
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function getByName($name)
    {
        $pegawai = DB::table('pegawais')
                    ->where('nama_pegawai', 'LIKE', '%'.$name.'%')            
                    ->get(); 
    
        if(!is_null($pegawai)) {
            return response([
            'message' => 'Retrieve Pegawai Success',
            'data' => $pegawai
            ],200);
        } 

        return response([
            'message' => 'Pegawai Not Found',
            'data' => null
        ],404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama_pegawai' => 'required|max:60|regex:/^[\pL\s]+$/u',
            'jenis_kelamin' => 'required',
            'hp_pegawai' => 'required|numeric|digits_between:10,13|starts_with:08',
            'jabatan_pegawai' => 'required',
            'alamat_pegawai' => 'required',
            'foto_pegawai' => 'nullable|file|image',
            'email_pegawai' => 'required|email:rfc,dns|unique:pegawais',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        if (!is_null($request->file('foto_pegawai'))) {
            $file          = $request->file('foto_pegawai');
            $nama_file     = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = 'pegawai_picture';
            $file->move($tujuan_upload, $nama_file);
        } else {
            $nama_file = 'avatar.png';
        }

        $pegawai = new Pegawai();
        $pegawai->nama_pegawai              = $storeData['nama_pegawai'];
        $pegawai->jenis_kelamin             = $storeData['jenis_kelamin'];
        $pegawai->hp_pegawai                = $storeData['hp_pegawai'];
        $pegawai->jabatan_pegawai           = $storeData['jabatan_pegawai'];
        $pegawai->foto_pegawai              = $nama_file;
        $pegawai->email_pegawai             = $storeData['email_pegawai'];
        $pegawai->password                  = bcrypt($request->password);

        $pegawai->save();

        return response([
            'message' => 'Add Pegawai Succes',
            'data' => $pegawai,
        ],200);
    }

    public function saveFoto(Request $request, $id) 
    {
        $pegawai = Pegawai::find($id);
        if (is_null($pegawai)) {
            return response([
                'message' => 'Pegawai Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'foto_pegawai' => 'nullable|file'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        if (!is_null($request->file('foto_pegawai'))) {
            $file          = $request->file('foto_pegawai');
            // $file          = str_replace(' ', '_', $file);
            $tujuan_upload = 'pegawai_picture';

            $nama_file     = $tujuan_upload . '/' . time() . "_" . $file->getClientOriginalName();
            
            $file->move($tujuan_upload, $nama_file);

            $pegawai->foto_pegawai     = $nama_file;
        }

        $pegawai->save();
        return response([
            'message' => 'Update Pegawai Success',
            'data' => $pegawai,
        ],200);
    }

    public function updateNoPass(Request $request, $id)
    {
        $pegawai = Pegawai::find($id);
        if (is_null($pegawai)) {
            return response([
                'message' => 'Pegawai Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_pegawai' => 'max:60|regex:/^[\pL\s]+$/u',
            'jenis_kelamin' => '',
            'hp_pegawai' => 'numeric|digits_between:10,13|starts_with:08',
            'jabatan_pegawai' => '',
            'email_pegawai' => ['email:rfc,dns', Rule::unique('pegawais')->ignore($pegawai)]
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $pegawai->nama_pegawai              = $updateData['nama_pegawai'];
        $pegawai->jenis_kelamin             = $updateData['jenis_kelamin'];
        $pegawai->hp_pegawai                = $updateData['hp_pegawai'];
        $pegawai->jabatan_pegawai           = $updateData['jabatan_pegawai'];
        $pegawai->email_pegawai             = $updateData['email_pegawai'];
        $pegawai->password                  = bcrypt($updateData['password']);

        $pegawai->save();
        return response([
            'message' => 'Update Pegawai Success',
            'data' => $pegawai,
        ],200);
    }

    public function updateAll(Request $request, $id)
    {
        $pegawai = Pegawai::find($id);
        if (is_null($pegawai)) {
            return response([
                'message' => 'Pegawai Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_pegawai' => 'max:60|regex:/^[\pL\s]+$/u',
            'jenis_kelamin' => '',
            'hp_pegawai' => 'numeric|digits_between:10,13|starts_with:08',
            'jabatan_pegawai' => '',
            'email_pegawai' => ['email:rfc,dns', Rule::unique('pegawais')->ignore($pegawai)],
            'password' => ''
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $pegawai->nama_pegawai              = $updateData['nama_pegawai'];
        $pegawai->jenis_kelamin             = $updateData['jenis_kelamin'];
        $pegawai->hp_pegawai                = $updateData['hp_pegawai'];
        $pegawai->jabatan_pegawai           = $updateData['jabatan_pegawai'];
        $pegawai->email_pegawai             = $updateData['email_pegawai'];
        $pegawai->password                  = bcrypt($updateData['password']);

        $pegawai->save();
        return response([
            'message' => 'Update Pegawai Success',
            'data' => $pegawai,
        ],200);
    }

    // public function updateAccount(Request $request, $id)
    // {
    //     $pegawai = Pegawai::find($id);

    //     $updateData = $request->all();
    //     $validate = Validator::make($updateData, [
    //         'email_pegawai' => ['email:rfc,dns', Rule::unique('pegawais')->ignore($pegawai)],
    //         'password' => ''
    //     ]); //membuat rule validasi input

    //     if ($validate->fails()) {
    //         return response(['message' => $validate->errors()], 400);
    //     }

    //     $pegawai->email_pegawai = $updateData['email_pegawai'];
    //     $pegawai->password   = bcrypt($request->password);

    //     $pegawai->save();
    //     return response([
    //         'message' => 'Update Account Pegawai Success',
    //         'data' => $pegawai,
    //     ]);
    // }

    public function updateStatus(Request $request, $id)
    {
        $pegawai = Pegawai::find($id);

        if ($pegawai->status_pegawai == 1) {
            $pegawai->status_pegawai = 0;
        } else if ($pegawai->status_pegawai == 0) {
            $pegawai->status_pegawai = 1;
        }

        $pegawai->save();
        return response([
            'message' => 'Update Status Pegawai Success',
            'data' => $pegawai,
        ],200);
    }    

    public function delete($id)
    {
        $pegawai = Pegawai::find($id);

        $pegawai->is_Deleted = 1;

        $pegawai->save();
        return response([
            'message' => 'Delete Pegawai Succes',
            'data' => $pegawai,
        ],200);
    }

    public function restore($id)
    {
        $pegawai = Pegawai::find($id);

        $pegawai->is_Deleted = 0;

        $pegawai->save();
        return response([
            'message' => 'Restore Pegawai Succes',
            'data' => $pegawai,
        ],200);
    }



}
