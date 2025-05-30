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
        Schema::create('jual', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_obat');
            $table->integer('jumlah');
            $table->double('harga', 15, 2);
            $table->double('subtotal', 15, 2);
            $table->timestamps();

            $table->foreign('id_obat')
                ->references('id')
                ->on('obat')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jual');
    }
};
