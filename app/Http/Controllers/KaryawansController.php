<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Karyawans;
use Illuminate\Http\Request;

class KaryawansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $karyawans = Karyawans::join('pekerjaans', 'karyawans.pekerjaan_id', '=', 'pekerjaans.id')
                ->select('karyawans.*', 'pekerjaans.pekerjaan')
                ->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Get all karyawans success',
                'data' => $karyawans,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Get all karyawans failed',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'           => 'required|string',
            'pekerjaan_id'   => 'integer',
            'divisi'         => 'required|string',
            'status'         => 'required|string'
        ]);

        $karyawans = new Karyawans([
            'nama'          => $request->nama,
            'pekerjaan_id'       => $request->pekerjaan_id,
            'divisi'         => $request->divisi,
            'status'         => $request->status
        ]);
        $karyawans->save();

        if ($karyawans) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data added succesfully',
                'data' => $karyawans
            ]);
        } else {
            return Response()->json([
                'status' => 'error',
                'message' => 'Error adding data',
                'data' => $karyawans
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            //find post by ID
            $karyawans = Karyawans::find($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Get data karyawans success',
                'data' => $karyawans,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Get data karyawans failed',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $karyawans = Karyawans::find($id);

        // Jika data siswa tidak ditemukan
        if (!$karyawans) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $request->validate([
            'nama'           => 'required|string',
            'pekerjaan_id'   => 'integer',
            'divisi'         => 'required|string',
            'status'         => 'required|string'
        ]);

        $karyawans->update([
            'nama'          => $request->nama,
            'pekerjaan_id'       => $request->pekerjaan_id,
            'divisi'         => $request->divisi,
            'status'         => $request->status
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data updated succesfully',
            'data' => $karyawans
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $karyawans = Karyawans::find($id);

        // Jika data siswa tidak ditemukan
        if (!$karyawans) {
            return response()->json(['message' => 'Karyawan not found'], 404);
        }

        $karyawans->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted succesfully',
            'data' => $karyawans
        ]);
    }

    public function count(Request $request)
    {
        try {
            $totalKaryawans = Karyawans::count();

            $aktif = Karyawans::where('status', 'aktif')
                ->get()->count();
            $nonaktif = Karyawans::where('status', 'nonaktif')
                ->get()->count();

            return response()->json([
                'status' => 'success',
                'message' => 'Get data count success',
                'data' => [
                    'total' => $totalKaryawans,
                    'aktif' => $aktif,
                    'nonaktif' => $nonaktif
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Get data count failed',
                'error' => $e->getMessage(),
            ]);
        }
    }
}
