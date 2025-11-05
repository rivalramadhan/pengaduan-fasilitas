<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduans';

    protected $fillable = [
        'user_id',
        'fasilitas_id',
        'judul',
        'isi',
        'tanggal_kejadian',
        'lokasi',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class);
    }

    public function tanggapans()
    {
        return $this->hasMany(Tanggapan::class);
    }

    public function fotos()
    {
        return $this->hasMany(FotoPengaduan::class);
    }
}
