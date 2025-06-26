<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::middleware(['auth'])->group(function () {
//     Route::redirect('settings', 'settings/profile');

//     Route::get('settings/profile', Profile::class)->name('settings.profile');
//     Route::get('settings/password', Password::class)->name('settings.password');
//     Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
// });

require __DIR__.'/auth.php';

use App\Http\Controllers\PrayerTimeController;

// Route untuk halaman utama jadwal shalat
Route::get('/jadwal-shalat', [PrayerTimeController::class, 'index'])->name('jadwal.index');

// Route untuk AJAX request (opsional)
Route::get('/api/jadwal-shalat', [PrayerTimeController::class, 'getByKota'])->name('jadwal.api');

// Route untuk mendapatkan adzan
Route::get('/api/adzan', [PrayerTimeController::class, 'getAdzan'])->name('adzan.api');

