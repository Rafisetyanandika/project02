<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Kota;

class PrayerTimeController extends Controller
{
    // Menampilkan halaman awal kosong (tanpa data)
    public function index()
    {
        $daftar_kota = Kota::all();
        return view('jadwal.index', compact('daftar_kota'));
    }

    // Ambil jadwal shalat berdasarkan kota
    public function getJadwal(Request $request)
    {
        $request->validate([
            'kota' => 'required|string',
        ]);

        $kota = $request->input('kota');
        $negara = 'Indonesia';

        try {
            $response = Http::get("https://api.aladhan.com/v1/timingsByCity", [
                'city' => $kota,
                'country' => $negara,
                'method' => 2,
            ]);

            $data = $response->json();

            if (!isset($data['data']['timings'])) {
                return back()->withErrors(['kota' => 'Kota tidak ditemukan atau terjadi kesalahan API.']);
            }

            return view('jadwal.index', [
                'jadwal' => $data['data']['timings'],
                'kota' => $kota,
                'timezone' => $data['data']['meta']['timezone'],
                'success' => 'Kota berhasil dipilih: ' . $kota,
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengambil data jadwal shalat: ' . $e->getMessage());
            return back()->withErrors(['kota' => 'Terjadi kesalahan saat mengambil data.']);
        }
    }
}
