<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $table = 'kota';

    protected $fillable = ['tanggal','imsak', 'subuh', 'terbit', 'dzuhur', 'ashar', 'maghrib','isya', 'timestamps'

];
}
