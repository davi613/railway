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
        'logo_ekspedisi',
        'ongkos_kirim'
    ];

    // Optionally, you can add accessors/mutators
    public function getLogoUrlAttribute()
    {
        return asset('storage/'.$this->logo_ekspedisi);
    }
}


