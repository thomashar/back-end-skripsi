<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DetailPesananController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryStokController;
use App\Http\Controllers\ResepController;

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

Route::get('/customer', [MenuController::class, 'getNotDeleted']);
Route::get('/customer/search={name}', [MenuController::class, 'getByName']);

Route::post('/register', [AuthController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    // Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('profile/{id}',[AuthController::class, 'show']);

    Route::get('/pegawai', [PegawaiController::class, 'getAll']);
    Route::get('/pegawaiMendaftar', [PegawaiController::class, 'getPegawaiMendaftar']);
    Route::get('/pegawai/{id}', [PegawaiController::class, 'getOne']);
    Route::get('/pegawaiByName/{name}', [PegawaiController::class, 'getByName']);
    Route::post('/pegawai', [PegawaiController::class, 'store']);
    Route::post('/pegawai/selfFoto/{id}', [PegawaiController::class, 'saveFoto']);
    Route::put('/pegawai/self/{id}', [PegawaiController::class, 'updateAll']);
    Route::put('/pegawai/selfNoPass/{id}', [PegawaiController::class, 'updateNoPass']);
    Route::put('/pegawai/status/{id}', [PegawaiController::class, 'updateStatus']);
    Route::put('/pegawai/softDelete/{id}', [PegawaiController::class, 'delete']);
    Route::put('/pegawai/restore/{id}', [PegawaiController::class, 'restore']);

    Route::get('/menu', [MenuController::class, 'getAll']);
    Route::get('/menuNotDeleted', [MenuController::class, 'getNotDeleted']);
    Route::get('/menuDeleted', [MenuController::class, 'getDeleted']);
    Route::get('/countMenu', [MenuController::class, 'countMany']);
    Route::get('/menu/{id}', [MenuController::class, 'getOne']);
    Route::get('/menuByName/{name}', [MenuController::class, 'getByName']);
    Route::post('/menu', [MenuController::class, 'store']);
    Route::post('/menu/upimg/{id}', [MenuController::class, 'saveFoto']);
    Route::put('/menu/{id}', [MenuController::class, 'update']);
    Route::put('/menu/softDelete/{id}', [MenuController::class, 'delete']);
    Route::put('/menu/restore/{id}', [MenuController::class, 'restore']);
    
    Route::get('/transaksi', [TransaksiController::class, 'getAll']);
    Route::get('/transaksiByName/{name}', [TransaksiController::class, 'getByName']);
    Route::get('/transaksi/{id}', [TransaksiController::class, 'getOne']);
    Route::post('/transaksi', [TransaksiController::class, 'store']);
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update']);
    Route::put('/transaksi/softDelete/{id}', [TransaksiController::class, 'delete']);
    Route::put('/transaksi/restore/{id}', [TransaksiController::class, 'restore']);

    Route::get('/pesanan', [PesananController::class, 'getAll']);
    Route::get('/pesanan/deleted', [StokController::class, 'getDeleted']);
    Route::get('/pesananByName/{id}', [PesananController::class, 'getByName']);
    Route::get('/pesanan/{id}', [PesananController::class, 'getOne']);
    Route::post('/pesanan', [PesananController::class, 'store']);
    Route::put('/pesanan/{id}', [PesananController::class, 'update']);
    Route::put('/pesanan/status/{id}', [PesananController::class, 'updateStatus']);
    Route::put('/pesanan/softDelete{id}', [PesananController::class, 'delete']);
    Route::put('/pesanan/restore/{id}', [PesananController::class, 'restore']);

    // Route::get('/stok', [StokController::class, 'get']);
    // Route::get('/stok/deleted', [StokController::class, 'getDeleted']);
    // Route::get('/stok/{id}', [StokController::class, 'getOne']);
    // Route::post('/stok', [StokController::class, 'store']);
    // Route::put('/stok/{id}', [StokController::class, 'update']);
    // Route::put('/stok/softDelete{id}', [StokController::class, 'delete']);
    // Route::put('/stok/restore/{id}', [StokController::class, 'restore']);

    Route::get('/historystok', [HistoryStokController::class, 'get']);
    Route::get('/historystok/deleted', [HistoryStokController::class, 'getDeleted']);
    Route::get('/historystok/{id}', [HistoryStokController::class, 'getOne']);
    Route::post('/historystok', [HistoryStokController::class, 'store']);
    Route::put('/historystok/{id}', [HistoryStokController::class, 'update']);
    Route::put('/historystok/{nama}', [HistoryStokController::class, 'tambahTotalStok']);
    Route::put('/historystok/softDelete{id}', [HistoryStokController::class, 'delete']);
    Route::put('/historystok/restore/{id}', [HistoryStokController::class, 'restore']);

    Route::get('/pembeli', [PembeliController::class, 'getAll']);
    Route::get('/pembeli/deleted', [StokController::class, 'getDeleted']);
    Route::get('/pembeli/{id}', [PembeliController::class, 'getOne']);
    Route::post('/pembeli', [PembeliController::class, 'store']);
    Route::put('/pembeli/{id}', [PembeliController::class, 'update']);
    Route::put('/pembeli/status/{id}', [PembeliController::class, 'updateStatus']);
    Route::put('/pembeli/softDelete{id}', [PembeliController::class, 'delete']);
    Route::put('/pembeli/restore/{id}', [PembeliController::class, 'restore']);
    Route::delete('/pembeli/{id}', [PembeliController::class, 'destroy']);

});

