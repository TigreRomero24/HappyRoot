<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\TaxesController;
use App\Http\Controllers\HomeClientController;
use App\Http\Controllers\Admin\PrecioController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/login', [RegisterUserController::class, 'Create'])->name('login');
Route::post('/login', [RegisterUserController::class, 'login'])->name('login.post');
Route::get('/register', [RegisterUserController::class, 'Registers'])->name('register');
Route::post('/register', [RegisterUserController::class, 'store'])->name('register.post');
Route::get('/logout', [RegisterUserController::class, 'logout'])->name('logout');

Route::prefix('dashboard-admin')->group(function () {
    Route::get('/', [HomeAdminController::class, 'listClients'])->name('dashboard-admin');
    Route::post('/', [HomeAdminController::class, 'addClients'])->name('dashboard-admin.post');
    Route::put('/{id}', [HomeAdminController::class, 'editClients'])->name('dashboard-admin.edit');
    Route::delete('/{id}', [HomeAdminController::class, 'deleteClients'])->name('dashboard-admin.delete');
});

Route::prefix('dashboard-admin')->group(function () {
    Route::get('/prices', [PrecioController::class, 'listPrice'])->name('dashboard-admin.prices');
    Route::post('/prices', [PrecioController::class, 'addPrice'])->name('dashboard-admin.prices.post');
    Route::put('/prices/{id}', [PrecioController::class, 'editPrice'])->name('dashboard-admin.prices.edit');
    Route::delete('/prices/{id}', [PrecioController::class, 'deletePrice'])->name('dashboard-admin.prices.delete');
});

Route::prefix('dashboard-admin')->group(function () {
    Route::get('/products', [ProductoController::class, 'listProducts'])->name('dashboard-admin.products');
    Route::post('/products', [ProductoController::class, 'addProducts'])->name('dashboard-admin.products.post');
    Route::put('/products/{id}', [ProductoController::class, 'editProducts'])->name('dashboard-admin.products.edit');
    Route::delete('/products/{id}', [ProductoController::class, 'deleteProducts'])->name('dashboard-admin.products.delete');
});

Route::get('/dashboard-admin/orders', [OrderController::class, 'listOrders'])->name('dashboard-admin.orders');

Route::prefix('dashboard-admin')->group(function () {
    Route::get('/taxes', [TaxesController::class, 'listTaxes'])->name('dashboard-admin.taxes');
    Route::post('/taxes', [TaxesController::class, 'addTaxes'])->name('dashboard-admin.taxes.post');
    Route::put('/taxes/{id}', [TaxesController::class, 'editTaxes'])->name('dashboard-admin.taxes.edit');
    Route::delete('/taxes/{id}', [TaxesController::class, 'deleteTaxes'])->name('dashboard-admin.taxes.delete');

    Route::get('/clients', [HomeAdminController::class, 'adminClient'])->name('dashboard-admin.clients');
    Route::get('/new-order', [HomeAdminController::class, 'adminNewOrder'])->name('dashboard-admin.new-order');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/client/profile', function () {
        return view('clientes/my_account_edit');
    })->name('client.profile');
    Route::put('/client/update-account', [HomeClientController::class, 'updateAccount'])->name('client.update-account');
    Route::put('/client/update-password', [HomeClientController::class, 'updatePassword'])->name('client.update-password');
});
Route::get('/client', [HomeClientController::class, 'index'])->name('dashboard-client');
Route::get('/client/new-order', [HomeClientController::class, 'client'])->name('dashboard-client.new-order');
Route::get('/client/orders', [HomeClientController::class, 'clientOrders'])->name('dashboard-client.orders');
Route::get('/client/profile', [HomeClientController::class, 'clientProfile'])->name('dashboard-client.profile');
