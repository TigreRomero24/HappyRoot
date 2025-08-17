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
        Schema::table('users', function (Blueprint $table) {
            $table->string('compania')->nullable();
            $table->string('pais')->nullable();
            $table->string('contacto')->nullable();
            $table->unsignedBigInteger('WholesPrice_id')->nullable();
            $table->string('role')->default('cliente');
            
            $table->foreign('WholesPrice_id')->references('id')->on('precios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
