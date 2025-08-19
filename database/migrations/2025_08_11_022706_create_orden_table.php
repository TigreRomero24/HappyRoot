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
        Schema::create('orden', function (Blueprint $table) {
            $table->id();
            $table->string('Shipment_id')->nullable();
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->string('origen')->default('Ecuador');
            $table->string('destino')->nullable();
            $table->string('container')->nullable();
            $table->date('fechaSalida')->nullable();
            $table->date('fechaLlegada')->nullable();
            $table->string('estado')->nullable();
            $table->string('total')->nullable();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden');
    }
};
