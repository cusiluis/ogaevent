<?php
// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:usuarios,email,' . $user->id,
        ]);

        $updateData = [
            'nombre' => $request->nombre,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|min:8|confirmed',
            ]);

            if (!Hash::check($request->current_password, $user->password_hash)) {
                return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta']);
            }

            $updateData['password_hash'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return redirect()->route('profile.edit')->with('success', 'Perfil actualizado exitosamente');
    }

    public function destroy()
    {
        $user = auth()->user();
        
        auth()->logout();
        
        $user->delete();
        
        return redirect('/')->with('success', 'Cuenta eliminada exitosamente');
    }
}