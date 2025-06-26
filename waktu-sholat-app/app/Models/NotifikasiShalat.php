<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotifikasiShalat extends Model
{
    protected $fillable = [
        'kota', 'waktu_shalat', 'waktu_notifikasi', 'pesan',
    ];
}
