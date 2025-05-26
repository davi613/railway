<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Jual extends Model

{
    use HasFactory;

    protected $table = 'jual';
    
    protected $fillable = [
        'id_obat',
        'jumlah',
        'harga',
        'subtotal',
    ];

    // Relasi ke tabel obat
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
    

}
