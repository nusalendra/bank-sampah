<?php

use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\NasabahController;
use App\Http\Controllers\Admin\PenimbanganSetoranController;
use App\Http\Controllers\Admin\RiwayatSetoranController;
use App\Http\Controllers\Admin\SampahController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Nasabah\SetorSampahController;
use App\Http\Controllers\Nasabah\TarikSaldoController;
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

// Bagian Nasabah 

// ambil data yang sedang login saat ini
Route::get('/setor-sampah/get-data-user', [SetorSampahController::class, 'getDataUser']);
// create setor sampah
Route::post('/setor-sampah/{id}', [SetorSampahController::class, 'store']);

// post tarik saldo
Route::get('/tarik-saldo/get-data-user', [TarikSaldoController::class, 'getDataUser']);
Route::post('/tarik-saldo/{id}', [TarikSaldoController::class, 'store']);

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
