<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('mostrar_nombre');
            $table->text('descripcion')->nullable();
            $table->string('modulo'); // usuarios, eventos, invitados, etc.
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permisos');
    }
}