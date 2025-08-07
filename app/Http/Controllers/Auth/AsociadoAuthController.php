<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Asociado;

class AsociadoAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.asociado-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $asociado = Asociado::where('email', $credentials['email'])->first();

        if ($asociado && Hash::check($credentials['password'], $asociado->password)) {
            Auth::guard('asociado')->login($asociado, $request->filled('remember'));
    
            $request->session()->regenerate();
    
            return redirect()->intended(route('asociado.dashboard'));
        }
    
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }


    public function logout(Request $request)
    {
        Auth::guard('asociado')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('asociado.login');
    }
}
