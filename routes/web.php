<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\TaxesController;
use App\Http\Controllers\HomeClientController;
use App\Http\Controllers\OrderClientController;
use App\Http\Controllers\Admin\PrecioController;
use App\Http\Controllers\GenerarpdfController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/login', [RegisterUserController::class, 'Create'])->name('login');
Route::post('/logins', [RegisterUserController::class, 'login'])->name('login.post');
Route::get('/register', [RegisterUserController::class, 'Registers'])->name('register');
Route::post('/register', [RegisterUserController::class, 'store'])->name('register.post');
Route::get('/logout', [RegisterUserController::class, 'logout'])->name('logout');

Route::prefix('dashboard-admin')->group(function () {
    Route::get('/', [HomeAdminController::class, 'listClients'])->name('dashboard-admin');
    Route::post('/clients', [HomeAdminController::class, 'addClients'])->name('dashboard-admin.post');
    Route::put('/{id}', [HomeAdminController::class, 'editClients'])->name('dashboard-admin.edit');
    Route::delete('/{id}', [HomeAdminController::class, 'deleteClients'])->name('dashboard-admin.delete');
});

Route::prefix('dashboard-admin')->group(function () {
    Route::get('/prices', [PrecioController::class, 'listPrice'])->name('dashboard-admin.prices');
    Route::post('/pricestates', [PrecioController::class, 'addPrice'])->name('dashboard-admin.prices.post');
    Route::put('/prices/{id}', [PrecioController::class, 'editPrice'])->name('dashboard-admin.prices.edit');
    Route::delete('/prices/{id}', [PrecioController::class, 'deletePrice'])->name('dashboard-admin.prices.delete');
});

Route::prefix('dashboard-admin')->group(function () {
    Route::get('/products', [ProductoController::class, 'listProducts'])->name('dashboard-admin.products');
    Route::post('/productstates', [ProductoController::class, 'addProducts'])->name('dashboard-admin.products.post');
    Route::put('/products/{id}', [ProductoController::class, 'editProducts'])->name('dashboard-admin.products.edit');
    Route::delete('/products/{id}', [ProductoController::class, 'deleteProducts'])->name('dashboard-admin.products.delete');
});

Route::prefix('dashboard-admin')->group(function () {
    Route::get('/orders', [OrderController::class, 'listOrders'])->name('dashboard-admin.orders');
    Route::get('/orders/create', [OrderController::class, 'createOrders'])->name('dashboard-admin.orders.create');
    Route::post('/calcular-totales', [OrderController::class, 'calcularTotales'])->name('orders.calcular');
    Route::post('/orderst', [OrderController::class, 'addOrder'])->name('dashboard-admin.orders.post');
    Route::post('/orders/edit/{id}',[OrderController::class, 'editOrder'])->name('dashboard-admin.orders.edit');
    Route::put('/orders/{id}', [OrderController::class, 'updateOrder'])->name('dashboard-admin.orders.update');
    Route::get('/orders/{id}/details', [OrderController::class, 'getOrderDetails'])->name('dashboard-admin.orders.details');
    Route::get('/buscarclientes', [OrderController::class, 'buscarClientes']);
    Route::get('/orders/{id}/pdf', [GenerarpdfController::class, 'generatePdf'])->name('dashboard-admin.orders.pdf');
});

Route::prefix('dashboard-admin')->group(function () {
    Route::get('/taxes', [TaxesController::class, 'listTaxes'])->name('dashboard-admin.taxes');
    Route::post('/taxestates', [TaxesController::class, 'addTaxes'])->name('dashboard-admin.taxes.post');
    Route::put('/taxes/{id}', [TaxesController::class, 'editTaxes'])->name('dashboard-admin.taxes.edit');
    Route::delete('/taxes/{id}', [TaxesController::class, 'deleteTaxes'])->name('dashboard-admin.taxes.delete');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/client/profile', [HomeClientController::class, 'client'])->name('client.profile');
    Route::put('/client/update-account', [HomeClientController::class, 'updateAccount'])->name('client.update-account');
    Route::put('/client/update-password', [HomeClientController::class, 'updatePassword'])->name('client.update-password');

    Route::get('/orders', [OrderClientController::class, 'listOrdersClient'])->name('client.orders');
    Route::post('/ordesCalcular', [OrderClientController::class, 'calcularTotalesclient'])->name('calcular.totales.client');
    Route::get('/orders/create', [OrderClientController::class, 'createOrdersClient'])->name('client.orders.create');
    Route::get('/orders/{id}', [OrderClientController::class, 'detailOrden'])->name('client.detail_order');

    Route::get('/orders/{id}/pdf', [GenerarpdfController::class, 'generatePdf'])->name('client.orders.pdf');
});


