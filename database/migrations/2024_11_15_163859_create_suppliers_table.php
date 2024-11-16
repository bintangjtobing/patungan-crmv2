<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique(); // UUID for supplier
            $table->string('name'); // Legal name of the supplier, e.g., Netflix, Microsoft
            $table->string('contact_email')->nullable(); // Email for official contact
            $table->string('contact_phone')->nullable(); // Phone number for official contact
            $table->string('address')->nullable(); // Address of the supplier
            $table->string('website')->nullable(); // Supplier's official website
            $table->boolean('is_active')->default(true); // Supplier status (active/inactive)
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}