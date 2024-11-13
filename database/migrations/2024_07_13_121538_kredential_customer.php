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
        Schema::create('kredential_customers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->require();
            $table->string('product_uuid')->require();
            $table->string('pin')->nullable();
            $table->string('email_akses')->require();
            $table->string('profil_akes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kredential_customers');
    }
};
