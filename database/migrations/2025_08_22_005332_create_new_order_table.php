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
        Schema::create('new_order', function (Blueprint $table) {
            $table->id();
            $table->string('destino')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('producto_id')->nullable();
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('taxes_id')->nullable();
            $table->decimal('total',8,2)->nullable();
            $table->timestamps();

            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('SET NULL');
            $table->foreign('usuario_id')->references('id')->on('User')->onDelete('SET NULL');
            $table->foreign('taxes_id')->references('id')->on('taxes')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_order');
    }
};
