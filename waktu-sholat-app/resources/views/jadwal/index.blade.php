@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">🕌 Jadwal Shalat Harian 📿</h2>

    {{-- Form Pilih Kota --}}
    <form method="POST" action="{{ route('jadwal.get') }}">
        @csrf
        <div class="mb-3">
            <label for="kota" class="form-label fw-bold">🏙️ Pilih Kota di Jawa Barat</label>
            <select name="kota" id="kota" class="form-control borderborder-2 border-dark rounded fw-bold" required>
                <option value="">-- 🌆 Pilih Kota --</option>
                @foreach($daftar_kota as $kota)
                <option value="{{ $kota->nama_kota }}" {{ (isset($kota) && $kota == $kota->nama_kota) ? 'selected' : '' }}>
                    {{ $kota->nama_kota }}
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success fw-bold">🔍 Lihat Jadwal</button>
    </form>

    {{-- Alert Sukses --}}
    @if (isset($success))
    <div class="alert alert-success mt-4 fw-bold">
        ✅ {{ $success }}
    </div>
    @endif

    {{-- Tampilkan Error --}}
    @if ($errors->any())
    <div class="alert alert-danger mt-4">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>⚠️ {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Hasil Jadwal --}}
    @if (isset($jadwal))
    <p class="text-muted mt-3"><small>🕓 Zona Waktu: {{ $timezone ?? 'Asia/Jakarta' }}</small></p>

    <h4 class="mt-4">📍 Jadwal Shalat di <strong>{{ $kota }}</strong> Hari Ini</h4>

    <table class="table table-bordered border-dark mt-3 text-center align-middle">
        <thead class="table-success fw-bold">
            <tr>
                <th>🌅 Subuh</th>
                <th>🏞️ Dzuhur</th>
                <th>🌇 Ashar</th>
                <th>🌆 Maghrib</th>
                <th>🌃 Isya</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>{{ $jadwal['Fajr'] }}</strong></td>
                <td><strong>{{ $jadwal['Dhuhr'] }}</strong></td>
                <td><strong>{{ $jadwal['Asr'] }}</strong></td>
                <td><strong>{{ $jadwal['Maghrib'] }}</strong></td>
                <td><strong>{{ $jadwal['Isha'] }}</strong></td>
            </tr>
        </tbody>
    </table>

    <p class="text-muted"><small>📍 Jadwal di atas berdasarkan waktu lokal kota {{ $kota }}.</small></p>
    @endif
</div>
@endsection