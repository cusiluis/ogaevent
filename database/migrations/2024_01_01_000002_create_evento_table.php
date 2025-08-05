<?php
// database/migrations/2024_01_01_000002_create_evento_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evento', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->text('descripcion')->nullable();
            $table->timestamp('hora_inicio');
            $table->timestamp('hora_fin');
            $table->string('ubicacion', 150)->nullable();
            $table->foreignId('created_by')->constrained('usuarios');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evento');
    }
};