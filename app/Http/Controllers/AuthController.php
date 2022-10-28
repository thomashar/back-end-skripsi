<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pegawai;
use Validator;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama_pegawai' => 'required|max:60|regex:/^[\pL\s]+$/u',
            'jenis_kelamin' => 'required',
            'hp_pegawai' => 'required|numeric|digits_between:10,13|starts_with:08',
            'alamat_pegawai' => 'required',
            'email_pegawai' => 'required|email:rfc,dns|unique:pegawais',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $pegawai = new Pegawai();
        $pegawai->nama_pegawai              = $storeData['nama_pegawai'];
        $pegawai->jenis_kelamin             = $storeData['jenis_kelamin'];
        $pegawai->hp_pegawai                = $storeData['hp_pegawai'];
        $pegawai->alamat_pegawai            = $storeData['alamat_pegawai'];
        $pegawai->email_pegawai             = $storeData['email_pegawai'];
        $pegawai->password                  = bcrypt($request->password);

        $pegawai->save();

        return response([
            'message' => 'Berhasil Mendaftar, Mohon Tunggu Penerimaan Pegawai',
            'data' => $pegawai,
        ],200);
    }

    public function login(Request $request)
    {
        $loginData = $request->all();
        $validate = Validator::make($loginData, [
            'email_pegawai' => 'required',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        if (!Auth::attempt($loginData)) {
            return response(['message' => 'Email Atau Password Tidak Valid'], 401);
        }

        $pegawai = Auth::user();

        if ($pegawai->status_pegawai == 0) {
            return response([
                'message' => 'Akun Anda Telah Di Nonaktifkan',
            ], 401);
        } else if ($pegawai->status_pegawai == 2) {
            return response([
                'message' => 'Akun Anda Belum Di Aktifkan',
            ], 401);
        } else {
            $token = $pegawai->createToken('Authentication Token')->accessToken;

            return response([
                'message' => 'Authenticated',
                'pegawai' => $pegawai,
                'token_type' => 'Bearer',
                'access_token' => $token
            ]);
        }
    }

    // public function logout(Request $request)
    // {
    //     $request->user()->token()->revoke();
    //     return response([
    //         'message' => 'Successfully logged out'
    //     ]);
    // }

    public function show($id)
    {
        $user = User::find($id);

        return response([
            'message' => 'Retrive User Success',
            'data' => $user
        ], 200);
    }
}
