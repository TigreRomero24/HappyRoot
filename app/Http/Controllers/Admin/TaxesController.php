<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Taxes;
use Illuminate\Http\Request;

class TaxesController extends Controller
{
    public function listTaxes()
    {
        $taxes = Taxes::all();
        return view('administrador/wholesale_ship_taxes', compact('taxes'));
    }

    public function addTaxes(Request $request)
    {
        Taxes::create([
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

        $tax = Taxes::findOrFail($id);
        $tax->update($validated);
        return redirect()->back()->with('success', 'Tax updated successfully.');
    }

    public function deleteTaxes($id)
    {
        $tax = Taxes::findOrFail($id);
        $tax->delete();
        return redirect()->back()->with('success', 'Tax deleted successfully.');
    }
}
