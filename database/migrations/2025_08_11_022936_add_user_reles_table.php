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
            $table->unsignedBigInteger('wholesPrice_id')->nullable();
            $table->string('role')->default('cliente');

            $table->foreign('wholesPrice_id')->references('id')->on('precios')->onDelete('SET NULL');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['wholesPrice_id']);
            $table->dropColumn('wholesPrice_id');
            $table->dropColumn(['compania', 'pais', 'contacto', 'role']);
        });
    }
};
