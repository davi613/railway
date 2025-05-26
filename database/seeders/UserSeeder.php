<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'), // Password dalam bentuk teks biasa
                'jabatan' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Apoteker',
                'email' => 'apoteker@gmail.com',
                'password' =>  Hash::make('apoteker123'), // Password dalam bentuk teks biasa
                'jabatan' => 'apoteker',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Karyawan',
                'email' => 'karyawan@gmail.com',
                'password' =>  Hash::make('karyawan123'), // Password dalam bentuk teks biasa
                'jabatan' => 'karyawan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kasir',
                'email' => 'kasir@gmail.com',
                'password' =>  Hash::make( 'kasir123'), // Password dalam bentuk teks biasa
                'jabatan' => 'kasir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pemilik',
                'email' => 'pemilik@gmail.com',
                'password' =>  Hash::make( 'pemilik123'), // Password dalam bentuk teks biasa
                'jabatan' => 'pemilik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}


