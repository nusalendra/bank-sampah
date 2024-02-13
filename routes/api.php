<?php

use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\NasabahController;
use App\Http\Controllers\Nasabah\SetorSampahController;
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

// ambil data yang sedang login saat ini
Route::get('/get-data-user', [SetorSampahController::class, 'getDataUser']);
// create setor sampah
Route::post('/setor-sampah/{id}', [SetorSampahController::class, 'store']);

// tampil data berita
Route::get('/berita', [BeritaController::class, 'index']);
// create berita
Route::post('/berita/create', [BeritaController::class, 'store']);

// Bagian Admin

// tampil data nasabah
Route::get('/nasabah', [NasabahController::class, 'index']);
// tampil detail data nasabah
Route::get('/nasabah/detail/{id}', [NasabahController::class, 'show']);



