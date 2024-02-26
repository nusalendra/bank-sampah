<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Nasabah;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required'],
            'jenis_kelamin' => ['required', 'string'],
            'nomor_telephone' => ['required', 'numeric'],
            'nomor_telephone' => ['max:12'],
            'foto_profil' => ['required', 'string'],
            'NIK' => ['required', 'max:16']
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->nomor_telephone = $request->nomor_telephone;
        $user->password = Hash::make($request->password);
        $user->role = 'Nasabah';

        $user->save();

        $nasabah = new Nasabah();
        $nasabah->user_id = $user->getKey();
        $nasabah->NIK = $request->NIK;
        $nasabah->status = 'Belum Aktif';

        $nasabah->save();

        return (new UserResource($user))->additional([]);
    }
}
