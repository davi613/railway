<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPengiriman extends Model
{
    use HasFactory;

    protected $table = 'jenis_pengiriman';

    protected $fillable = [
        'jenis_kirim',
        'nama_ekspedisi',
        'logo_ekspedisi',
        'ongkos_kirim'
    ];

    public function getLogoUrlAttribute()
    {
        return asset('storage/' . $this->logo_ekspedisi);
    }

    /**
     * Relasi ke tabel penjualan
     */
    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'id_jenis_kirim');
    }
}