<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalKegiatan extends Model
{
    protected $fillable = ['title', 'description', 'date', 'tahun_ajaran'];
    protected $casts = [
        'date' => 'date',
    ];
}
