<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\productos;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function listProducts()
    {
        $producto = productos::all();
        return view('administrador/wholesale_products', compact('producto'));
    }

    public function addProducts(Request $request)
    {
        productos::create([
            'nombre' => $request->input('nombre'),
            'tipo' => $request->input('tipo'),
            'descripcion' => $request->input('descripcion'),
            'precio' => $request->input('precio'),
        ]);
        return redirect()->back()->with('success', 'Product added successfully.');
    }

    public function editProducts(Request $request, $id)
    {
        $validatated= $request->validate([
            'nombre' => 'required|string',
            'tipo' => 'required|string',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
        ]);

        $producto = productos::findOrFail($id);
        $producto->update($validatated);
        return redirect()->back()->with('success', 'Product updated successfully.');
    }

    public function deleteProducts($id)
    {
        $producto = productos::findOrFail($id);
        $producto->delete();
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
}
