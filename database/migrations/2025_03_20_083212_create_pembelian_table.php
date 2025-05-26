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
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('nonota', 100);
            $table->date('tgl_pembelian');
            $table->double('total_bayar', 15, 2);
            $table->unsignedBigInteger('id_distributor');
            $table->timestamps();

            $table->foreign('id_distributor')->references('id')->on('distributor')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian');
    }
};
