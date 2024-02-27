<?php

use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\NasabahController;
use App\Http\Controllers\Admin\PenimbanganSetoranController;
use App\Http\Controllers\Admin\RiwayatSetoranController;
use App\Http\Controllers\Admin\SampahController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Nasabah\NotifikasiController;
use App\Http\Controllers\Nasabah\RiwayatTransaksiController;
use App\Http\Controllers\Nasabah\SetorSampahController;
use App\Http\Controllers\Nasabah\TarikSaldoController;
use App\Http\Controllers\ProfilController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', RegisterController::class);
Route::post('/login', LoginController::class);
Route::post('/lupa-password', ForgotPasswordController::class);

Route::middleware(['auth:sanctum'])->group(function () {
    // Bagian Nasabah 

    // get data user
    Route::get('/get-data-user', [ProfilController::class, 'getDataUser']);
    Route::post('/ubah-password', [ProfilController::class, 'ubahPassword']);

    // create setor sampah
    Route::post('/setor-sampah', [SetorSampahController::class, 'store']);

    // post tarik saldo
    Route::post('/tarik-saldo', [TarikSaldoController::class, 'store']);
    
    // get data notifikasi
    Route::get('/get-data-notifikasi', [NotifikasiController::class, 'getDataNotifikasi']);

    // get data riwayat transaksi
    Route::get('/get-data-riwayat-transaksi', [RiwayatTransaksiController::class, 'getDataRiwayatTransaksi']);

    Route::put('/update-profil-nasabah', [ProfilController::class, 'updateProfilNasabah']);

    // Bagian Admin

    // tampil data nasabah
    Route::get('/nasabah', [NasabahController::class, 'index']);
    // tampil detail data nasabah
    Route::get('/nasabah/detail/{id}', [NasabahController::class, 'show']);

    // tampil data keseluruhan di penimbangan setoran
    Route::get('/penimbangan-setoran', [PenimbanganSetoranController::class, 'index']);
    // tampil data yang akan di edit di penimbangan setoran
    Route::get('/penimbangan-setoran/edit/{id}', [PenimbanganSetoranController::class, 'edit']);
    // update data penimbangan setoran
    Route::put('/penimbangan-setoran/update', [PenimbanganSetoranController::class, 'update']);

    // tampil data riwayat setoran
    Route::get('/riwayat-setoran', [RiwayatSetoranController::class, 'index']);
    // tampil detail data riwayat setoran
    Route::get('/riwayat-setoran/detail/{id}', [RiwayatSetoranController::class, 'show']);

    // tampil data sampah
    Route::get('/sampah', [SampahController::class, 'index']);
    // create sampah
    Route::post('/sampah/create', [SampahController::class, 'store']);

    // tampil data berita
    Route::get('/berita', [BeritaController::class, 'index']);
    // create berita
    Route::post('/berita/create', [BeritaController::class, 'store']);
});
