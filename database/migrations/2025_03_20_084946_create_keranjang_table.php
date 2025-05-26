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
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id(); // Ini sama dengan BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->unsignedBigInteger('id_pelanggan'); // BIGINT UNSIGNED NOT NULL
            $table->unsignedBigInteger('id_obat'); // BIGINT UNSIGNED NOT NULL
            $table->double('jumlah_order'); // DOUBLE NOT NULL
            $table->double('harga', 15, 2); // DOUBLE NOT NULL
            $table->double('subtotal', 15, 2); // DOUBLE NOT NULL
            $table->timestamps(); // Ini akan membuat created_at dan updated_at

            // Foreign key constraints
            $table->foreign('id_pelanggan')->references('id')->on('pelanggan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_obat')->references('id')->on('obat')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};
