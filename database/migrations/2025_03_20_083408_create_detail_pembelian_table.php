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
        Schema::create('detail_pembelian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_obat');
            $table->integer('jumlah_beli');
            $table->double('harga_beli', 15, 2);
            $table->double('subtotal', 15, 2);
            $table->unsignedBigInteger('id_pembelian');
            $table->timestamps();

            $table->foreign('id_pembelian')->references('id')->on('pembelian')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_obat')->references('id')->on('obat')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pembelian');
    }
};
