<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Producto;
use App\Models\Precio;
use App\Models\Taxes;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function listOrders()
    {
        $orders = Order::with('product', 'taxes', 'user')->latest()->get();
        $products = Producto::all();
        $precios = Precio::all();
        $taxes = Taxes::all();
        $users = User::all();
        return view('administrador/wholesale_orders', compact('orders', 'products', 'precios', 'taxes', 'users'));
    }

    public function createOrders()
    {
        $orders = Order::with('product', 'taxes', 'user')->get();
        $products = Producto::all();
        $precios = Precio::all();
        $taxes = Taxes::all();
        $users = User::all();
        return view('administrador/wholesale_new_order', compact('orders', 'products', 'precios', 'taxes', 'users'));
    }

    public function buscarClientes(Request $request)
    {
        $clientes = User::where('nombre', 'LIKE', '%' . $request->input('q') . '%')->select('id', 'nombre')->get();

        return response()->json($clientes);
    }

    public function calcularTotales(Request $request)
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

    public function addOrder(Request $request)
    {
        try {
            $request->validate([
                'usuario_id' => 'required|exists:users,id',
                'destino' => 'required|string',
                'address' => 'required|string',
                'productos' => 'required|array|min:1',
            ]);
        
            $usuarioId = $request->usuario_id;
            $destino = $request->destino;
            $address = $request->address;
            $productos = $request->productos;
        
            $user = User::find($usuarioId);
            $descuentoPorcentaje = 0.0; // Por ahora sin descuento para evitar errores
        
            $total = 0.0;
            $totalProducts = 0.0;
            $totalShippingTaxes = 0.0;
            $orders = [];
    
        // Crear una orden simple para prueba
        $item = $productos[0]; 
        
        $productoModel = Producto::find($item['producto_id']);
        if (!$productoModel) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 400);
        }
        
        $cantidad = (int) $item['cantidad'];
        $precioUnitario = $item['tipo'] === 'Pallets'
            ? (float) $productoModel->precio_pallets
            : (float) $productoModel->precio_boxes;
        

        $subtotalProduct = $precioUnitario * $cantidad;
        $subtotalConDescuento = $descuentoPorcentaje > 0
                ? $subtotalProduct * (1 - ($descuentoPorcentaje / 100))
                : $subtotalProduct;
        
        $tipoFrontend = $item['tipo'];
        $tipoTax = $tipoFrontend; 

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

        // Generar códigos únicos
        $timestamp = time();
        $random = rand(1000, 9999);
        $codigoShipment = 'SHI-' . $timestamp . '-' . $random;
        $codigoContainer = 'CONT-' . $timestamp . '-' . $random;

        // Crear orden
        $order = Order::create([
            'shipment_id' => $codigoShipment,
            'container' => $codigoContainer,
            'destino' => $destino,
            'address' => $address,
            'producto_id' => $productoModel->id,
            'usuario_id' => $usuarioId,
            'total' => $total,
            'cantidad' => $cantidad,
            'tipo' => $item['tipo'],
            'origen' => 'Ecuador',
            'estado' => 'Pending',
        ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'order' => $order,
                'total_final' => $total
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating orders: ' . $e->getMessage(),
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function editOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $products = Producto::all();
        $taxes = Taxes::all();
        $users = User::all();
        $precios = Precio::all();
        return view('dashboard-admin.orders', compact('order', 'products', 'taxes', 'users', 'precios'));
    }

    public function updateOrder(Request $request, $id)
    {
        $request->validate([
            'shipment_id' => 'required|string',
            'destino' => 'required|string',
            'address' => 'required|string',
            'origen' => 'required|string',
            'container' => 'required|string',
            'fechaSalida' => 'nullable|date',
            'fechaLlegada' => 'nullable|date',
            'estado' => 'required|string',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'shipment_id' => $request->shipment_id,
            'destino' => $request->destino,
            'address' => $request->address,
            'origen' => $request->origen,
            'container' => $request->container,
            'fechaSalida' => $request->fechaSalida,
            'fechaLlegada' => $request->fechaLlegada,
            'estado' => $request->estado,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order updated successfully',
            'order' => $order
        ]);
    }


    public function getOrderDetails($id)
    {
        $order = Order::with('product', 'taxes', 'user')->findOrFail($id);
        
        $details = [
            'id' => $order->id,
            'shipment_id' => $order->shipment_id,
            'container' => $order->container,
            'client' => $order->user->nombre ?? 'N/A',
            'client_email' => $order->user->email ?? 'N/A',
            'client_company' => $order->user->compania ?? 'N/A',
            'origin' => $order->origen ?? 'N/A',
            'destination' => $order->destino,
            'address' => $order->address,
            'product' => $order->product->nombre ?? 'N/A',
            'product_type' => $order->tipo ?? 'N/A',
            'quantity' => $order->cantidad ?? 1,
            'total' => $order->total,
            'shipping_taxes' => $order->taxes ? [
                'taxes' => $order->taxes->taxes,
                'intercom' => $order->taxes->intercom,
                'profit' => $order->taxes->profit,
                'total' => $order->taxes->total
            ] : null,
            'departure_date' => $order->fechaSalida ? $order->fechaSalida->format('Y-m-d') : 'N/A',
            'arrival_date' => $order->fechaLlegada ? $order->fechaLlegada->format('Y-m-d') : 'N/A',
            'status' => $order->estado ?? 'Pending',
            'created_at' => $order->created_at->format('Y-m-d H:i:s')
        ];
        
        return response()->json($details);
    }

    public function getShippingTaxes($destino, $tipo)
    {
        $tipoTax = $tipo === 'pallet' ? 'Pallets' : 'Boxes';
        
        return Taxes::where('destino', $destino)
                    ->where('tipo', $tipoTax)
                    ->first();
    }

    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('dashboard-admin.orders')->with('success', 'Order deleted successfully.');
    }
}
