<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function getDataUser()
    {
        try {
            $data = Auth::user();

            $user = User::with('nasabah')->find($data->id);

            return response()->json([
                'status' => true,
                'message' => 'Data Berhasil Didapat',
                'data' => $user,
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
