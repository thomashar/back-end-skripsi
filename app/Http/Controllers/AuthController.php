<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pegawai;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginData = $request->all();
        $validate = Validator::make($loginData, [
            'email' => 'required|email:rfc,dns',
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

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response([
            'message' => 'Successfully logged out'
        ]);
    }
}
