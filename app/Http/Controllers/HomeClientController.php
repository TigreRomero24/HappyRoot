<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeClientController extends Controller
{
    public function index()
    {
        return view('clientes/orders');
    }

    public function client()
    {
        return view('clientes/new_order_client');
    }

    public function updateAccount(Request $request)
    {
        try {
            $user = auth()->user();
            $updated = false;

            // Verifica qué campo se está actualizando
            if ($request->has('nombre')) {
                $request->validate(['nombre' => 'required|string|max:255|unique:users,nombre,' . $user->id]);
                $user->nombre = $request->nombre;
                $updated = true;
            }
            if ($request->has('email')) {
                $request->validate(['email' => 'required|email|unique:users,email,' . $user->id]);
                $user->email = $request->email;
                $updated = true;
            }
            if ($request->has('compania')) {
                $request->validate(['compania' => 'required|string|max:255']);
                $user->compania = $request->compania;
                $updated = true;
            }
            if ($request->has('pais')) {
                $request->validate(['pais' => 'required|string|max:255']);
                $user->pais = $request->pais;
                $updated = true;
            }
            if ($request->has('contacto')) {
                $request->validate(['contacto' => 'required|string|max:255']);
                $user->contacto = $request->contacto;
                $updated = true;
            }

            if ($updated) {
                $user->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Campo actualizado correctamente'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No se encontró el campo a actualizar'
            ], 400);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el campo'
            ], 500);
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('client.profile')->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('client.profile')->with('success', 'Password updated successfully!');
    }

}
