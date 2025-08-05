<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// database/migrations/2024_create_user_roles_table.php
class CreateUserRolesTable extends Migration
{
    public function up()
    {
        Schema::create('usuario_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('rol_id')->constrained()->onDelete('cascade');
            $table->timestamp('assigned_at')->useCurrent();
            $table->foreignId('assigned_by')->nullable()->constrained('usuarios');
            $table->timestamps();
            
            $table->unique(['usuario_id', 'rol_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuario_roles');
    }
}