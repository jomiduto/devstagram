<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    // public function store(Request $request)
    // {
    //     // dd('Autenticando...');

    //     $validated = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);

    //     // En caso de que el usuario no se pueda autenticar
    //     if (!auth()->attempt($request->only('email','password'))) {
    //         return back()->with('mensaje', 'Credenciales incorrectas');
    //     }
    //     // Si esta logueado
    //     return redirect()->route('posts.index');
    // }

    public function authenticate(Request $request): RedirectResponse
    {
        // dd($request->remember);
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->remember)) {
            $request->session()->regenerate();

            return redirect()->route('posts.index', auth()->user()->username );
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }
}
