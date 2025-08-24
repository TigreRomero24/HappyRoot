<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderClientController extends Controller
{
    public function listOrdersClient()
    {
        $orders = Order::with('product', 'taxes', 'user')->latest()->get();
        $products = Producto::all();
        $precios = Precio::all();
        $taxes = Taxes::all();
        $users = User::all();
        return view('clientes/orders', compact('orders', 'products', 'precios', 'taxes', 'users'));
    }

    public function createOrdersClient()
    {
        $orders = Order::with('product', 'taxes', 'user')->get();
        $products = Producto::all();
        $precios = Precio::all();
        $taxes = Taxes::all();
        $users = User::all();
        return view('clientes/new_order_client', compact('orders', 'products', 'precios', 'taxes', 'users'));
    }

    public function addOrderClient(Request $request)
    {

        $userId = auth()->user()->isAdmin()
                    ? $request->usuario_id
                    : auth()->id(); 

        $tax = Taxes::where('destino', $request->destino)
                    ->where('tipo', $request->tipo)
                    ->first();

        $subtotal = $request->cantidad * $tax->total;

        // aplicar descuento si el usuario tiene wholesaleprices
        $user = User::find($userId);
        if ($user && $user->wholesaleprices) {
            $subtotal = $subtotal * (1 - ($user->wholesaleprices / 100));
        }

        $lastOrder = Order::latest()->first();
        $nextId = $lastOrder ? $lastOrder->id + 1 : 1;

        $codigoShipment = 'SHI-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        $codigoContainer = 'CONT-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        $order = Order::create([
            'shipment_id' => $codigoShipment,
            'container' => $codigoContainer,
            'destino' => $request->destino,
            'address' => $request->address,
            'producto_id' => $request->producto_id,
            'usuario_id' => $userId,
            'taxes_id' => $tax->id,
            'total' => $subtotal,
        ]);

        return redirect()->route('dashboard-client')->with('success', 'Order added successfully.');
    }

}
