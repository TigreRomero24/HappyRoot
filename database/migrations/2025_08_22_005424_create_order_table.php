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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('Shipment_id')->nullable();
            $table->unsignedBigInteger('new_order_id')->nullable();
            $table->string('origen')->default('Ecuador');
            $table->string('destino')->nullable();
            $table->string('container')->nullable();
            $table->date('fechaSalida')->nullable();
            $table->date('fechaLlegada')->nullable();
            $table->string('estado')->nullable();
            $table->string('total')->nullable();
            $table->timestamps();

            $table->foreign('new_order_id')->references('id')->on('new_order')->onDelete('SET NULL'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
