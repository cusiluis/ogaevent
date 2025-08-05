<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// database/migrations/2024_create_role_permissions_table.php
class CreateRolePermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('rol_permisos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rol_id')->constrained()->onDelete('cascade');
            $table->foreignId('permiso_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['rol_id', 'permiso_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('rol_permisos');
    }
}