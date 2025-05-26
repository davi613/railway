<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model
     * (Laravel secara default menggunakan bentuk plural dari nama model)
     */
    protected $table = 'distributor';

    /**
     * Kolom yang dapat diisi (fillable)
     */
    protected $fillable = [
        'nama_distributor',
        'telepon',
        'alamat',
    ];

    /**
     * Kolom yang harus disembunyikan saat serialisasi
     */
    protected $hidden = [
        // Tambahkan kolom yang ingin disembunyikan jika ada
    ];

    /**
     * Casting tipe data untuk kolom tertentu
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
