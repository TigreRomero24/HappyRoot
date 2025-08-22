<?php

namespace App\Http\Controllers\Admin;

use App\Models\precio;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeAdminController extends Controller
{
    public function listClients()
    {
        $clients = User::where('role', 'cliente')->with('wholesPrice')->get();
        $precios = Precio::all();

        return view('administrador/wholesale_admin', compact('precios', 'clients'));
    }

    public function addClients(Request $request)
    {
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'pais' => 'required|string|max:255',
                'compania' => 'required|string|max:255',
                'contacto' => 'required|string|max:255',
                'wholesPrice_id' => 'nullable|exists:precios,id',
            ]);

            $user = User::create([
                'nombre' => $validated['nombre'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'pais' => $validated['pais'],
                'compania' => $validated['compania'],
                'contacto' => $validated['contacto'],
                'wholesPrice_id' => $validated['wholesPrice_id'],
                'role' => 'cliente',  // Agregar el role por defecto
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Cliente agregado correctamente'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al agregar el cliente: ' . $e->getMessage()
            ], 500);
        }
    }

    public function editClients(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8',  // Removido 'confirmed'
                'pais' => 'required|string|max:255',
                'compania' => 'required|string|max:255',
                'contacto' => 'required|string|max:255',
                'wholesPrice_id' => 'nullable|exists:precios,id',
            ]);

            $client = User::findOrFail($id);
            
            // Remover password si no se proporcionó uno nuevo
            if (empty($validated['password'])) {
                unset($validated['password']);
            } else {
                $validated['password'] = Hash::make($validated['password']);
            }

            $client->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Cliente actualizado correctamente'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el cliente: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteClients($id)
    {
        $client = User::findOrFail($id);
        $client->delete();
        return redirect()->back()->with('success', 'Cliente eliminado correctamente');
    }
}
