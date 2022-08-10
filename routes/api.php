<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\RoleController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('register','PegawaiController@store');
// Route::post('login','AuthController@login');

// // Route::group(['middleware' => 'auth:api'], function () {
//     Route::post('logout','AuthController@logout');

//     Route::get('pegawai','PegawaiController@getAll');
//     Route::get('pegawai/{id}','PegawaiController@getOne');
//     Route::post('pegawai','PegawaiController@store');
//     Route::put('pegawai/{id}','PegawaiController@update');
//     Route::put('pegawai/{id}','PegawaiController@updateStatus');
//     Route::put('pegawai/{id}','PegawaiController@delete');
//     Route::put('pegawai/{id}','PegawaiController@restore');

//     Route::get('role','RoleController@get');
//     Route::get('role/{id}','RoleController@getOne');
//     Route::post('role','RoleController@store');
//     Route::put('role/{id}','RoleController@update');
//     Route::put('role/{id}','RoleController@delete');
//     Route::put('role/{id}','RoleController@restore');

//     Route::get('menu','MenuController@get');
//     Route::get('menu/{id}','MenuController@getOne');
//     Route::post('menu','MenuController@store');
//     Route::put('menu/{id}','MenuController@update');
//     Route::put('menu/{id}','MenuController@delete');
//     Route::put('menu/{id}','MenuController@restore');

//     Route::get('pesanan','PesananController@getAll');
//     Route::get('pesanan/{id}','PesananController@getOne');
//     Route::post('pesanan','PesananController@store');
//     Route::put('pesanan/{id}','PesananController@update');
//     Route::put('pesanan/{id}','PesananController@updateStatus');
//     Route::put('pesanan/{id}','PesananController@delete');
//     Route::put('pesanan/{id}','PesananController@restore');

//     Route::get('stok','StokController@get');
//     Route::get('stok/{is_Deleted}','PegawaiController@getDeleted');
//     Route::get('stok/{id}','StokController@getOne');
//     Route::post('stok','StokController@store');
//     Route::put('stok/{id}','StokController@update');
//     Route::put('stok/{id}','StokController@delete');
//     Route::put('stok/{id}','StokController@restore');

//     Route::get('pembeli','PembeliController@getAll');
//     Route::get('pembeli/{id}','PembeliController@getOne');
//     Route::post('pembeli','PembeliController@store');
//     Route::put('pembeli/{id}','PembeliController@update');
//     Route::put('pembeli/{id}','PembeliController@updateStatus');
//     Route::put('pembeli/{id}','PembeliController@delete');
//     Route::put('pembeli/{id}','PembeliController@restore');
//     Route::delete('pembeli/{id}','PembeliController@destroy');

// });


Route::get('/pegawai', [PegawaiController::class, 'getAll']);
Route::get('/role', [RoleController::class, 'get']);
