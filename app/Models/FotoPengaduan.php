<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FotoPengaduan extends Model
{
    use HasFactory;
    protected $fillable = ['pengaduan_id', 'path'];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }
}
