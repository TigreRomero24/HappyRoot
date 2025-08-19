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
        dd($request->all());
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'pais' => 'required|string|max:255',
            'compania' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            'wholesPrice_id' => 'nullable|exists:precios,id',
        ]);

        $precios = precio::all();
        User::create([
            'nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'pais' => $request->input('pais'),
            'compania' => $request->input('compania'),
            'contacto' => $request->input('contacto'),
            'wholesPrice_id' => $request->input('wholesPrice_id'),
        ]);
        return redirect()->back()->with('success', 'Client added successfully.');

    }

    public function editClients(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'pais' => 'required|string|max:255',
            'compania' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            'wholesPrice_id' => 'nullable|exists:precios,id',
        ]);

        $client = User::findOrFail($id);
        $client->update($validated);
        if (!empty($validated['password'])) {
            $client->password = Hash::make($validated['password']);
        }
        $client->save();
        return redirect()->back()->with('success', 'Client updated successfully.');
    }

    public function deleteClients($id)
    {
        $client = User::findOrFail($id);
        $client->delete();
        return redirect()->back()->with('success', 'Client deleted successfully.');
    }

}
