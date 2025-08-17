<?php

namespace App\Http\Controllers;
use App\Models\productos;
use App\Models\precio;
use App\Models\taxes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    public function admin()
    {
        return view('administrador/wholesale_admin');
    }

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

    public function listProducts()
    {
        $productos = productos::all();
        return view('administrador/wholesale_products', compact('productos'));
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

    public function listTaxes()
    {
        $taxes = taxes::all();
        return view('administrador/wholesale_ship_taxes', compact('taxes'));
    }

    public function addTaxes(Request $request)
    {
        taxes::create([
            'destino' => $request->input('destino'),
            'tipo' => $request->input('tipo'),
            'taxes' => $request->input('taxes'),
            'intercom' => $request->input('intercom'),
            'profit' => $request->input('profit'),
            'total' => $request->input('taxes') + $request->input('intercom') + $request->input('profit'),
        ]);
        return redirect()->back()->with('success', 'Tax added successfully.');
    }

    public function editTaxes(Request $request, $id)
    {
        $validated = $request->validate([
            'destino' => 'required|string',
            'tipo' => 'required|string',
            'taxes' => 'required|numeric',
            'intercom' => 'required|numeric',
            'profit' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        $tax = taxes::findOrFail($id);
        $tax->update($validated);
        return redirect()->back()->with('success', 'Tax updated successfully.');
    }

    public function deleteTaxes($id)
    {
        $tax = taxes::findOrFail($id);
        $tax->delete();
        return redirect()->back()->with('success', 'Tax deleted successfully.');
    }

    public function adminOrder()
    {
        return view('wholesale_orders');
    }

    public function adminClient()
    {
        return view('wholesale_add_new_client');
    }

    public function adminNewOrder()
    {
        return view('wholesale_new_order');
    }
}
