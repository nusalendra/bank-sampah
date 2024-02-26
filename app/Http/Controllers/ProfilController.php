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

    public function ubahPassword(Request $request)
    {
        $userLogin = Auth::user();

        $validator = Validator::make($request->all(), [
            'password_lama' => 'required',
            'password_baru' => 'required',
            'ulangi_password_baru' => 'required|same:password_baru'
        ]);

        if ($validator->fails()) {
            $validator->errors()->first();
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => null
            ], 422);
        }

        if (!Hash::check($request->password_lama, $userLogin->password)) {
            return response()->json(['error' => 'Password lama tidak cocok'], 422);
        }

        try {
            $user = User::find($userLogin->id);
            $user->password = Hash::make($request->password_baru);
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Password Berhasil Diubah'
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
