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
        'lampiran',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
