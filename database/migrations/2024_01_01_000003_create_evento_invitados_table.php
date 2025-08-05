<?php
// database/migrations/2024_01_01_000003_create_evento_invitados_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evento_invitados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evento_id')->constrained('evento')->onDelete('cascade');
            $table->foreignId('invitado_id')->constrained('invitados')->onDelete('cascade');
            $table->foreignId('registrado_por')->constrained('usuarios');
            $table->timestamp('hora_de_registro')->nullable();
            $table->timestamp('hora_de_salida')->nullable();
            $table->string('estado', 50)->default('pendiente');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evento_invitados');
    }
};