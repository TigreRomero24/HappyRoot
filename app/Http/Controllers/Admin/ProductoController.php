<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function listProducts()
    {
        $producto = Producto::all();
        return view('administrador/wholesale_products', compact('producto'));
    }

    public function addProducts(Request $request)
    {
        Producto::create([
            'nombre' => $request->input('nombre'),
            'precio_pallets' => $request->input('precio_pallets'),
            'precio_boxes' => $request->input('precio_boxes'),
            'descripcion' => $request->input('descripcion')
        ]);
        return redirect()->back()->with('success', 'Product added successfully.');
    }

    public function editProducts(Request $request, $id)
    {
        $validatated= $request->validate([
            'nombre' => 'required|string',
            'precio_pallets' => 'required|numeric',
            'precio_boxes' => 'required|numeric',
            'descripcion' => 'required|string',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($validatated);
        return redirect()->back()->with('success', 'Product updated successfully.');
    }

    public function deleteProducts($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
}
