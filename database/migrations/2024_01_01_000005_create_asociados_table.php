<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsociados2Table extends Migration
{
    public function up()
    {
        Schema::create('asociados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('telefono', 20)->nullable();
            $table->string('email', 100)->unique();
            $table->string('cargo', 50)->default('asociado');
            $table->string('regional', 100);
            $table->timestamps(); // incluye created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asociados');
    }

}