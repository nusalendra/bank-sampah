<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomor_telephone' => 'required|exists:users,nomor_telephone',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $validator->errors()->first();
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => null
            ], 422);
        }

        try {
            $user = User::where('nomor_telephone', $request->nomor_telephone)->first();
            $user->password = Hash::make($request->password);
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
