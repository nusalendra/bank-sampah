<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function getDataNotifikasi()
    {
        try {
            $user = Auth::user();
            $data = Notifikasi::where('user_id', '=', $user->id)->get();

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
