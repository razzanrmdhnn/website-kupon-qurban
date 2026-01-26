<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kupon;
use Illuminate\Http\Request;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class KuponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kupon::query();

        // Filter berdasarkan pencarian nama
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan RT
        if ($request->filled('rt')) {
            $query->where('rt', $request->rt);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $kupons = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistik
        $totalKupon = Kupon::count();
        $kuponTersedia = Kupon::tersedia()->count();
        $kuponTerpakai = Kupon::terpakai()->count();

        return view('Admin.kelola-kupon.index', compact(
            'kupons',
            'totalKupon',
            'kuponTersedia',
            'kuponTerpakai'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'rt' => 'required|string|max:2',
        ]);

        // Generate kode unik
        $kodeUnik = Kupon::generateKodeUnik();

        // Generate QR Code sebagai raw SVG markup (bukan data URI)
        $options = new QROptions([
            'outputType' => QRCode::OUTPUT_MARKUP_SVG,
            'outputBase64' => false, // Raw SVG, bukan base64 data URI
            'eccLevel' => QRCode::ECC_H,
            'addQuietzone' => true,
            'cssClass' => 'qrcode',
            'svgWidth' => 200,
            'svgHeight' => 200,
        ]);

        $qrcode = new QRCode($options);
        $qrCodeSvg = $qrcode->render($kodeUnik);

        // Simpan kupon (simpan SVG langsung, bukan base64)
        Kupon::create([
            'nama' => $request->nama,
            'rt' => $request->rt,
            'kode_unik' => $kodeUnik,
            'qr_code' => $qrCodeSvg,
            'status' => 'tersedia',
        ]);

        return redirect()->route('kelola-kupon.index')
            ->with('success', 'Kupon berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kupon $kupon)
    {
        return response()->json($kupon);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kupon $kupon)
    {
        $kupon->delete();

        return redirect()->route('kelola-kupon.index')
            ->with('success', 'Kupon berhasil dihapus!');
    }
}
