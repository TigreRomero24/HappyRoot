<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\password;

class RegisterUserController extends Controller
{

    public function create()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Usuario autenticado
            $user = Auth::user();  // Obtenemos el usuario logueado
            
            if ($user->role == 'admin') {
                return redirect()->route('dashboard-admin')->with('success', 'Logged in successfully!');
            } elseif ($user->role == 'cliente') {
                return redirect()->intended('dashboard-client')->with('success', 'Logged in successfully!');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function Registers()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'compania' => 'nullable|string',
            'pais' => 'required|string',
            'contacto' => 'required|string',
        ]);
    
        User::create([
            'nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'compania' => $request->input('compania'),
            'pais' => $request->input('pais'),
            'contacto' => $request->input('contacto'),
        ]);
    
        return redirect()->route('login')->with('success', 'User registered successfully!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente');
    }
}