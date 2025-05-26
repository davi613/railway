<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisObat extends Model
{
    use HasFactory;

    // Atur nama tabel secara manual
    protected $table = 'jenis_obat';

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'jenis',
        'deskripsi_jenis',
        'image_url',
    ];

    // Relasi ke model Obat
    public function obats()
    {
        return $this->hasMany(Obat::class, 'idjenis');
    }
}
