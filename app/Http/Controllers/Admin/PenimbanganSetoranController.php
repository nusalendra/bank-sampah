<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sampah;
use App\Models\SetorSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenimbanganSetoranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = SetorSampah::where('status', 'Proses')->with('user')->get();

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        try {
            $data = SetorSampah::with('user')->findOrFail($id);

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sampah_id' => 'required',
            'berat_sampah' => 'required',
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
            // mengirim id sampah
            $sampahIds = $request->sampah_id;
            // mengirim id setor sampah
            $setorSampahId = $request->setor_sampah_id;

            $createPivotTable = [];
            $totalSetoran = [];
            foreach ($sampahIds as $sampahId) {
                $data = Sampah::findOrFail($sampahId);

                $createPivotTable[] = [
                    'sampah_id' => $data->id,
                    'setor_sampah_id' => $setorSampahId,
                    'berat_sampah' => $request->berat_sampah,
                ];

                $totalSetoran[] = $request->berat_sampah * $data->harga_per_kg;
            }

            $totalSetoran = array_sum($totalSetoran);

            $setorSampah = SetorSampah::findOrFail($setorSampahId);
            $setorSampah->status = 'Dikonfirmasi';
            $setorSampah->total_setoran = $totalSetoran;
            $setorSampah->save();

            $setorSampah->sampah()->attach($createPivotTable);

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
