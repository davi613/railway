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
        Schema::create('obat', function (Blueprint $table) {
            $table->id(); // mengandung 'bigint' unsigned
            $table->string('nama_obat', 100);
            // $table->foreign('idjenis')->references('id')->on('jenis_obat')->onDelete('cascade');
            $table->unsignedBigInteger('idjenis');
            $table->foreign('idjenis')->references('id')
            ->on('jenis_obat')->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->integer('harga_jual');
            $table->text('deskripsi_obat')->nullable();
            $table->string('foto1', 255)->nullable();
            $table->string('foto2', 255)->nullable();
            $table->string('foto3', 255)->nullable();
            $table->integer('stok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obat');
    }
};
