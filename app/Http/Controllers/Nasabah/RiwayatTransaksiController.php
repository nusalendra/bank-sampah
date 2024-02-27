<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\RiwayatTransaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RiwayatTransaksiController extends Controller
{
    public function getDataRiwayatTransaksi()
    {
        try {
            $user = Auth::user();
            $data = RiwayatTransaksi::where('user_id', '=', $user->id)->get();

            return response()->json([
                'status' => true,
                'message' => 'Data Berhasil Didapat',
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }
}
