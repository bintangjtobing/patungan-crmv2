<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Drop foreign key constraint first
            $table->dropForeign(['supplier_id']);

            // Then drop the 'supplier_id' column
            $table->dropColumn('supplier_id');

            // Add the new 'supplier_uuid' column
            $table->uuid('supplier_uuid')->nullable()->after('product_uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Remove the 'supplier_uuid' column
            $table->dropColumn('supplier_uuid');

            // Re-add the 'supplier_id' column
            $table->unsignedBigInteger('supplier_id')->nullable()->after('product_uuid');

            // Re-add the foreign key constraint for 'supplier_id'
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }
};