<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\precio;
use Illuminate\Http\Request;

class PrecioController extends Controller
{
    public function listPrice()
    {
        $precios = precio::all();
        return view('administrador/wholesale_prices', compact('precios'));
    }

    public function addPrice(Request $request)
    {
        precio::create([
            'nombre' => $request->input('nombre'),
            'descuentos' => $request->input('descuentos'),
        ]);

        return redirect()->back()->with('success', 'Price added successfully.');
    }

    public function editPrice(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'descuentos' => 'required|numeric',
        ]);

        $precio = precio::findOrFail($id);
        $precio->update($validated);
        return redirect()->back()->with('success', 'Price updated successfully.');
    }

    public function deletePrice($id)
    {
        $precio = precio::findOrFail($id);
        $precio->delete();
        return redirect()->back()->with('success', 'Price deleted successfully.');
    }    
}
