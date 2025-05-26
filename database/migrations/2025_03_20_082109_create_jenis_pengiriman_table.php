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
        Schema::create('jenis_pengiriman', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_kirim',['ekonomi', 'kargo', 'regular', 'same day', 'standar']);
            $table->string('nama_ekspedisi', 255); 
            $table->string('logo_ekspedisi', 255); 
            $table->double('ongkos_kirim', 15, 2);
            // $table->decimal('ongkos_kirim', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_pengiriman');
    }
};
