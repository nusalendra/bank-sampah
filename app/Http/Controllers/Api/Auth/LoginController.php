<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'nomor_telephone' => ['required', 'numeric'],
            'nomor_telephone' => ['max:12'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($credentials)) {
            $user = auth()->user();

            return (new UserResource($user))->additional([
                'token' => $user->createToken('myAppToken')->plainTextToken,
            ]);
        }

        return response()->json([
            'message' => 'Gagal Login !',
        ], 401);
    }
}
