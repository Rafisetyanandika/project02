<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adzan extends Model
{
    protected $fillable = [
        'nama',
        'audio_path',
    ];

        // Accessor untuk mendapatkan full URL audio
    public function getAudioUrlAttribute()
    {
        return asset('storage/' . $this->audio_path);
    }

    // Scope untuk mencari adzan berdasarkan nama shalat
    public function scopeByPrayerName($query, $prayerName)
    {
        return $query->where('nama', 'like', '%' . $prayerName . '%');
    }
}
