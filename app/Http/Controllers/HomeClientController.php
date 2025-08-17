<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeClientController extends Controller
{
    public function index()
    {
        return view('index_cliente');
    }

    public function client()
    {
        return view('clientes/new_order_client');
    }

    public function clientOrders()
    {
        return view('clientes/orders');
    }

    public function clientProfile()
    {
        return view('clientes/my_account_edit');
    }

}
