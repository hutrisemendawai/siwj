<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalKelas extends Model
{
    protected $fillable = [
        'nama_mata_kuliah',
        'dosen_pengajar_1',
        'dosen_pengajar_2',
        'jumlah_sks',
        'ruangan',
        'jam_mulai',
        'jam_selesai',
        'deskripsi',
        'color',
        'hari',
    ];
}
