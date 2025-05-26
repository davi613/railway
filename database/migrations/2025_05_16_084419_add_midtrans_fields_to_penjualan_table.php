<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->string('snap_token')->nullable()->after('status_order');
            $table->string('payment_token')->nullable()->after('snap_token');
            $table->string('payment_url')->nullable()->after('payment_token');
            $table->string('transaction_status')->nullable()->after('payment_url');
            $table->string('transaction_id')->nullable()->after('transaction_status');
        });
    }

    public function down()
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->dropColumn([
                'snap_token',
                'payment_token',
                'payment_url',
                'transaction_status',
                'transaction_id'
            ]);
        });
    }
};