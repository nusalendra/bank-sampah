<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\SetorSampah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SetorSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'bukti_setor' => 'required'
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
            $data = new SetorSampah();
            $data->user_id = $user->id;
            $data->tanggal = $request->tanggal;
            if ($request->hasFile('bukti_setor')) {
                $file = $request->file('bukti_setor');
                $filename = 'Nasabah ' . $user->name . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('bukti-setor'), $filename);
                $data->bukti_setor = $filename;
            }
            $data->status = 'Proses';

            $data->save();

            return response()->json([
                'status' => true,
                'message' => 'Data Berhasil Ditambahkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
