<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Producto;
use App\Models\Precio;
use App\Models\Taxes;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderClientController extends Controller
{
    public function listOrdersClient()
    {
        $orders = Order::with('product', 'taxes')
                ->where('usuario_id', auth()->id())
                ->latest()
                ->get();

        return view('clientes/orders', compact('orders'));
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

    public function calcularTotalesclient(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'destino' => 'required|string',
            'productos' => 'required|array|min:1',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.tipo' => 'required|in:Pallets,Boxes',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        $usuarioId = (int) $request->usuario_id;
        $destino = $request->destino;
        $productos = $request->productos;

        $user = User::find($usuarioId);
        $descuentoPorcentaje = 0.0; // Por ahora sin descuento para evitar errores

        $totalProducts = 0.0;
        $totalShippingTaxes = 0.0;
        $detalleProductos = [];

        foreach ($productos as $item) {
            $productoModel = Producto::find($item['producto_id']);
            if (!$productoModel) continue;

            $tipoFrontend = $item['tipo'];
            $tipoTax = $tipoFrontend; 

            $cantidad = (int) $item['cantidad'];
            $precioUnitario = $tipoFrontend === 'Pallets'
                ? (float) $productoModel->precio_pallets
                : (float) $productoModel->precio_boxes;

            $subtotalProduct = $precioUnitario * $cantidad;

            // Aplica descuento
            $subtotalConDescuento = $descuentoPorcentaje > 0
                ? $subtotalProduct * (1 - ($descuentoPorcentaje / 100))
                : $subtotalProduct;

            $shippingTax = Taxes::where('destino', $destino)
                                ->where('tipo', $tipoTax)
                                ->first();

            $shippingTaxAmount = 0.0;
            if ($shippingTax) {
                $shippingTaxAmount = (float) $shippingTax->total * $cantidad;
            }

            $totalProducts += $subtotalConDescuento;
            $totalShippingTaxes += $shippingTaxAmount;

            $total = round($totalProducts + $totalShippingTaxes, 2);

            $detalleProductos[] = [
                'producto_id' => $productoModel->id,
                'nombre' => $productoModel->nombre,
                'tipo' => $tipoFrontend,
                'cantidad' => $cantidad,
                'precio_unitario' => $precioUnitario,
                'subtotal' => $subtotalConDescuento,
                'shipping_tax_total' => $shippingTaxAmount,
                'shipping_tax_breakdown' => [
                    'total' => $shippingTax ? $shippingTax->total : 0
                ]
            ];
        }

        return response()->json([
            'total_products' => round($totalProducts, 2),
            'shipping_taxes' => round($totalShippingTaxes, 2), // Cambio: shipping + taxes
            'descuento' => $descuentoPorcentaje,
            'total_final' => $total,
            'detalle_productos' => $detalleProductos,
        ]);

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

        return redirect()->route('client.orders')->with('success', 'Order added successfully.');
    }

    public function detailOrden($id)
    {
        $order = Order::with('product', 'taxes', 'user')
                    ->where('usuario_id', auth()->id())
                    ->findOrFail($id);

        return response()->json($order);
    }
}
