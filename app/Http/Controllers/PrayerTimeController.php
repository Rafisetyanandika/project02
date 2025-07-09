<?php

namespace App\Http\Controllers;

use App\Models\JadwalShalat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Kota;
use App\Models\Adzan;

class PrayerTimeController extends Controller
{
    // Menampilkan halaman awal kosong (tanpa data)
    public function index()
    {
        // Ambil semua data jadwal shalat
        $jadwal_shalat = JadwalShalat::all();
        
        // Ambil daftar kota yang unik
        $kota_list = JadwalShalat::select('kota')->distinct()->pluck('kota');
        
        // Ambil semua data adzan
        $adzan_list = Adzan::all();
        
        return view('jadwal.index', compact('jadwal_shalat', 'kota_list', 'adzan_list'));
    }
    
    // Method untuk AJAX request (opsional)
    public function getByKota(Request $request)
    {
        $kota = $request->get('kota');
        
        if (!$kota) {
            return response()->json(['error' => 'Kota tidak ditemukan'], 404);
        }
        
        $jadwal = JadwalShalat::where('kota', $kota)->first();
        
        if (!$jadwal) {
            return response()->json(['error' => 'Jadwal tidak ditemukan untuk kota tersebut'], 404);
        }
        
        return response()->json($jadwal);
    }
    
    // Method untuk mendapatkan adzan berdasarkan waktu shalat
    public function getAdzan(Request $request)
    {
        $nama_shalat = $request->get('shalat');
        
        $adzan = Adzan::where('nama', 'like', '%' . $nama_shalat . '%')->first();
        
        if (!$adzan) {
            return response()->json(['error' => 'Adzan tidak ditemukan'], 404);
        }
        
        return response()->json([
            'nama' => $adzan->nama,
            'audio_path' => $adzan->audio_path,
            'audio_url' => asset('storage/' . $adzan->audio_path)
        ]);
    }
}
