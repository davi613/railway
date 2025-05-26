<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Model
{
    use HasFactory, Notifiable;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'users';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'name',
        'email',
        'password',
        'jabatan',
    ];

    // Kolom yang harus disembunyikan (tidak ditampilkan)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Kolom yang harus di-cast ke tipe data tertentu
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}

