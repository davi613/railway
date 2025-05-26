<?php

namespace App\Models;
// app/Models/Obat.php
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    // Atur nama tabel secara manual
    protected $table = 'obat';

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'nama_obat',
        'idjenis',
        'harga_jual',
        'deskripsi_obat',
        'foto1',
        'foto2',
        'foto3',
        'stok',
    ];

    // Relasi ke model JenisObat
    public function jenisObat()
    {
        return $this->belongsTo(JenisObat::class, 'idjenis');
    }
}