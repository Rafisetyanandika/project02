<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalShalat extends Model
{
    use HasFactory;

    protected $fillable = [
        'kota', 'tanggal', 'subuh', 'dzuhur', 'ashar', 'maghrib', 'isya', 'timezone'
    ];
}
