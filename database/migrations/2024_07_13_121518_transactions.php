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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->require();
            $table->boolean('jenis_transaksi')->require();
            $table->string('product_uuid')->require();
            $table->text('description')->nullable();
            $table->string('jumlah')->require()->default(1);
            $table->integer('harga')->require();
            $table->dateTime('tanggal_waktu_transaksi_selesai')->nullable();
            $table->integer('status')->require();
            $table->string('bukti_transaksi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
