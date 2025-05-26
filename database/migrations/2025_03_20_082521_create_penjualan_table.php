<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id(); // id : bigint(20) unsigned
            $table->unsignedBigInteger('id_metode_bayar');
            $table->date('tgl_penjualan');
            $table->string('url_resep', 255)->nullable();
            $table->double('ongkos_kirim', 15, 2);
            $table->double('biaya_app', 15, 2);
            $table->double('total_bayar', 15, 2);

            $table->enum('status_order',
            [
                'Menunggu Konfirmasi', 'Diproses', 'Menunggu Kurir', 
                'Dibatalkan Pembeli', 'Dibatalkan Penjual', 'Bermasalah', 
                'Selesai'
            ]);
            
            $table->string('keterangan_status', 255)->nullable();
            $table->unsignedBigInteger('id_jenis_kirim');
            $table->unsignedBigInteger('id_pelanggan');
            $table->timestamps(); // created_at dan updated_at

            $table->foreign('id_metode_bayar')->references('id')->on('metode_bayar')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_jenis_kirim')->references('id')->on('jenis_pengiriman')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_pelanggan')->references('id')->on('pelanggan')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
