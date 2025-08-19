<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\productos;
use App\Models\precio;
use App\Models\taxes;
use App\Models\orden;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function listOrders()
    {
        $orders = orden::all()->with('');
        $products = productos::all();
        $precios = precio::all();
        $taxes = taxes::all();
        $users = User::all();
        return view('administrador/wholesale_orders', compact('orders', 'products', 'precios', 'taxes', 'users'));
    }

    public function addOrder(Request $request)
    {
        $request->validate([
            'Shipment_id' => 'required|string|max:255',
            'usuario_id' => 'nullable|exists:users,id',
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'container' => 'required|string|max:255',
            'fechaSalida' => 'required|date',
            'fechaLlegada' => 'required|date',
            'estado' => 'required|string|max:255',
            'total' => 'required|numeric|min:0'
        ]);

        $order = new orden();
        $order->Shipment_id = $request->Shipment_id;
        $order->usuario_id = $request->usuario_id;
        $order->origen = $request->origen;
        $order->destino = $request->destino;
        $order->container = $request->container;
        $order->fechaSalida = $request->fechaSalida;
        $order->fechaLlegada = $request->fechaLlegada;
        $order->estado = $request->estado;
        $order->total = $request->total;
        $order->quantity = $request->quantity;
        $order->shipping_address = $request->shipping_address;
        $order->save();

        return redirect()->route('administrador.wholesale_orders')->with('success', 'Order added successfully.');
    }
}
