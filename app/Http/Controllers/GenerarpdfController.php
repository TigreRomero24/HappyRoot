<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class GenerarpdfController extends Controller
{
    public function generatePdf($id)
    {
        $order = Order::find($id);
        $pdf = Pdf::loadView('pdf.order', compact('order'));
        return $pdf->download('order_'.$id.'.pdf');
    }
}
