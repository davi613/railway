<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisObatSeeder extends Seeder
{
    public function run()
    {
        DB::table('jenis_obat')->insert([
            [
                'jenis' => 'Obat Biasa',
                'deskripsi_jenis' => 'Obat yang dapat dibeli tanpa resep dokter.',
                'image_url' => 'https://example.com/obat-biasa.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenis' => 'Obat Keras',
                'deskripsi_jenis' => 'Obat yang memerlukan resep dokter untuk dibeli.',
                'image_url' => 'https://example.com/obat-keras.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}