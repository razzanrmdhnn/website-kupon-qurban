<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kupon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ScanKuponController extends Controller
{
    /**
     * Display scan kupon page
     */
    public function index()
    {
        return view('Admin.scan-kupon.index');
    }

    /**
     * Check/verify kupon by kode_unik
     */
    public function checkKupon(Request $request): JsonResponse
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        $code = strtoupper(trim($request->code));

        $kupon = Kupon::where('kode_unik', $code)->first();

        if (!$kupon) {
            return response()->json([
                'success' => false,
                'message' => 'Kupon tidak ditemukan. Pastikan kode yang dimasukkan benar.'
            ], 404);
        }

        if ($kupon->status === 'terpakai') {
            return response()->json([
                'success' => false,
                'message' => 'Kupon ini sudah digunakan pada ' . $kupon->tanggal_penukaran->format('d/m/Y H:i'),
                'kupon' => [
                    'id' => $kupon->id,
                    'kode_unik' => $kupon->kode_unik,
                    'nama' => $kupon->nama,
                    'rt' => $kupon->formatted_rt,
                    'status' => $kupon->status,
                    'tanggal_penukaran' => $kupon->tanggal_penukaran?->format('d/m/Y H:i')
                ]
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Kupon ditemukan dan tersedia',
            'kupon' => [
                'id' => $kupon->id,
                'kode_unik' => $kupon->kode_unik,
                'nama' => $kupon->nama,
                'rt' => $kupon->formatted_rt,
                'status' => $kupon->status,
                'tanggal_penukaran' => null
            ]
        ]);
    }

    /**
     * Use/redeem kupon - change status to terpakai
     */
    public function useKupon(Request $request): JsonResponse
    {
        $request->validate([
            'kupon_id' => 'required|integer|exists:kupons,id'
        ]);

        $kupon = Kupon::find($request->kupon_id);

        if (!$kupon) {
            return response()->json([
                'success' => false,
                'message' => 'Kupon tidak ditemukan'
            ], 404);
        }

        if ($kupon->status === 'terpakai') {
            return response()->json([
                'success' => false,
                'message' => 'Kupon ini sudah digunakan sebelumnya'
            ], 400);
        }

        $kupon->update([
            'status' => 'terpakai',
            'tanggal_penukaran' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kupon berhasil divalidasi dan ditandai sebagai terpakai',
            'kupon' => [
                'id' => $kupon->id,
                'kode_unik' => $kupon->kode_unik,
                'nama' => $kupon->nama,
                'rt' => $kupon->formatted_rt,
                'status' => $kupon->status,
                'tanggal_penukaran' => $kupon->tanggal_penukaran->format('d/m/Y H:i')
            ]
        ]);
    }
}
