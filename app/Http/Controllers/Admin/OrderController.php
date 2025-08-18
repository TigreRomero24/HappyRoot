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
        $orders = orden::all();
        $products = productos::all();
        $precios = precio::all();
        $taxes = taxes::all();
        $users = User::all();
        return view('administrador/wholesale_orders', compact('orders', 'products', 'precios', 'taxes', 'users'));
    }

    public function addOrder(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:productos,id',
            'quantity' => 'required|integer|min:1',
            'shipping_address' => 'required|string|max:255',
        ]);

        $order = new orden();
        $order->client_id = $request->client_id;
        $order->product_id = $request->product_id;
        $order->quantity = $request->quantity;
        $order->shipping_address = $request->shipping_address;
        $order->save();

        return redirect()->route('administrador.wholesale_orders')->with('success', 'Order added successfully.');
    }
}
