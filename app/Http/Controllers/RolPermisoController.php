<?php
namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\Permiso;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class RolPermisoController extends Controller
{
    public function indexRoles() {
        return view('roles.index', ['roles' => Roles::all()]);
    }

    public function createRole() {
        return view('roles.create', ['permisos' => Permiso::all()]);
    }

    public function storeRole(Request $request) {
        $role = Roles::create($request->only('nombre', 'slug'));
        $role->permisos()->sync($request->permisos);
        return redirect()->route('roles.index');
    }

    public function editRole(Roles $role) {
        return view('roles.create', [
            'role' => $role,
            'permisos' => Permiso::all()
        ]);
    }

    public function updateRole(Request $request, Roles $role) {
        $role->update($request->only('nombre', 'slug'));
        $role->permisos()->sync($request->permisos);
        return redirect()->route('roles.index');
    }

    public function destroyRole(Roles $role) {
        $role->delete();
        return back();
    }

    public function assignRoleForm() {
        return view('roles.assign', [
            'usuarios' => Usuario::all(),
            'permisos' => Permiso::all(),
            'roles' => Roles::all()
        ]);
    }

    public function assignRole(Request $request) {
        $user = Usuario::findOrFail($request->user_id);
        $user->roles()->sync($request->roles);
        return back();
    }

    public function indexPermissions() {
        return view('permisos.index', ['permisos' => Permiso::all()]);
    }

    public function storePermission(Request $request) {
        Permiso::create($request->only('nombre', 'slug'));
        return back();
    }
}
