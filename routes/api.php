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
use App\Http\Controllers\LaporanController;

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

Route::get('/getPesanan', [PesananController::class, 'getPesanan']);
Route::post('/simpanPesanan', [PesananController::class, 'store']);

Route::post('/detailPesanan', [DetailPesananController::class, 'store']);

Route::post('/simpanTransaksi', [TransaksiController::class, 'store']);
Route::get('/getTransaksi/{id_pesanan}', [TransaksiController::class, 'getOne']);

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
    Route::get('/transaksi/{id_pesanan}', [TransaksiController::class, 'getOne']);
    Route::post('/transaksi', [TransaksiController::class, 'store']);
    Route::post('/transaksi/{id}', [TransaksiController::class, 'update']);
    Route::put('/transaksiDone/{id}/{id_pegawai}', [TransaksiController::class, 'updateStatus']);
    Route::put('/transaksi/softDelete/{id}', [TransaksiController::class, 'delete']);
    Route::put('/transaksi/restore/{id}', [TransaksiController::class, 'restore']);

    Route::post('/tambahDetailPesanan', [DetailPesananController::class, 'store']);
    Route::get('/getDetailPesanan/{id_pesanan}', [DetailPesananController::class, 'getDetailPesanan']);
    Route::post('/detailPesanan/{id}', [DetailPesananController::class, 'update']);
    Route::put('/detailPesanan/softDelete/{id}', [DetailPesananController::class, 'delete']);

    Route::get('/pesanan', [PesananController::class, 'getAll']);
    Route::get('/pesanan/deleted', [StokController::class, 'getDeleted']);
    Route::get('/pesananByName/{id}', [PesananController::class, 'getByName']);
    Route::get('/pesanan/{id}', [PesananController::class, 'getOne']);
    Route::post('/pesanan', [PesananController::class, 'store']);
    Route::post('/pesanan/{id}', [PesananController::class, 'update']);
    Route::put('/pesanan/status/{id}', [PesananController::class, 'updateStatus']);
    Route::put('/pesanan/softDelete{id}', [PesananController::class, 'delete']);
    Route::put('/pesanan/restore/{id}', [PesananController::class, 'restore']);

    Route::get('/pendapatanBulan/{bulan}', [LaporanController::class, 'pendapatanBulanan']);
    Route::get('/pendapatanTahun/{tahun}', [LaporanController::class, 'pendapatanTahunan']);
    Route::get('/penjualanMenuBulan/{bulan}', [LaporanController::class, 'penjualanMenuBulan']);
    Route::get('/penjualanMenuTahun/{tahun}', [LaporanController::class, 'penjualanMenuTahun']);
});

