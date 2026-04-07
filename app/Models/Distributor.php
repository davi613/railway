<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;

    protected $table = 'distributor';

    protected $fillable = [
        'nama_distributor',
        'telepon',
        'alamat',
    ];

    protected $hidden = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke tabel pembelian
     */
    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'id_distributor');
    }
}