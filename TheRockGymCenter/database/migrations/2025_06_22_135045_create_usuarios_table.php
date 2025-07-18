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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->text('cedula')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('email')->unique()->nullable(true);
            $table->string('telefono')->nullable(); 
            $table->boolean('estado')->default('true'); // 'activo', 'inactivo'
            $table->string('acciones')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
