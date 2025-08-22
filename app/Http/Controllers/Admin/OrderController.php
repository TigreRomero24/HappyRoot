<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\productos;
use App\Models\precio;
use App\Models\taxes;
use App\Models\order;
use App\Models\new_order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function listOrders()
    {
        $new_orders = new_order::with('productOrders', 'taxesOrders', 'userOrders')->get();
        $orders = order::with('orderDetails')->get();
        $products = productos::all();
        $precios = precio::all();
        $taxes = taxes::all();
        $users = User::all();
        return view('dashboard-admin.orders', compact('orders', 'products', 'precios', 'taxes', 'users', 'new_orders'));
    }

    public function addOrder(Request $request)
    {
        $request->validate([
            'destino' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'producto_id' => 'required|exists:productos,id',
            'usuario_id' => 'required|exists:users,id',
            'taxes_id' => 'required|exists:taxes,id',
            'total' => 'nullable|numeric|min:0'
        ]);

        $order = new order();
        $order->destino = $request->destino;
        $order->address = $request->address;
        $order->producto_id = $request->producto_id;
        $order->usuario_id = $request->usuario_id;
        $order->taxes_id = $request->taxes_id;
        $order->total = $request->total;
        $order->save();

        return redirect()->route('dashboard-admin.orders')->with('success', 'Order added successfully.');
    }

    public function editOrder(Request $request, $id)
    {
        $order = order::findOrFail($id);
        $productos = productos::all();
        $taxes = taxes::all();
        return view('dashboard-admin.orders', compact('order', 'productos', 'taxes'));
    }

    public function deleteOrder($id)
    {
        $order = order::findOrFail($id);
        $order->delete();
        return redirect()->route('dashboard-admin.orders')->with('success', 'Order deleted successfully.');
    }
}
