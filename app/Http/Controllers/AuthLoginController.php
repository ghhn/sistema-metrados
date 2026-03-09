<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthLoginController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'dni' => ['required', 'string', 'max:15'],
            'clave' => ['required', 'string', 'min:4'],
        ]);

        // ✅ Auth::attempt compara 'clave' vs password_hash automáticamente (Hash::check)
        $ok = Auth::attempt([
            'dni' => $data['dni'],
            'password' => $data['clave'], // 👈 OJO: siempre se llama 'password' aquí
        ]);

        if (! $ok) {
            return back()->withErrors(['dni' => 'DNI o clave incorrectos'])->withInput();
        }

        // Bloqueo por estado
        if ((int) auth()->user()->estado !== 1) {
            Auth::logout();

            return back()->withErrors(['dni' => 'Usuario inactivo'])->withInput();
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
