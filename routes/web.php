<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\HomeClientController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/login', [RegisterUserController::class, 'Create'])->name('login');
Route::post('/login', [RegisterUserController::class, 'login'])->name('login.post');
Route::get('/register', [RegisterUserController::class, 'Registers'])->name('register');
Route::post('/register', [RegisterUserController::class, 'store'])->name('register.post');
Route::get('/logout', [RegisterUserController::class, 'logout'])->name('logout');

Route::get('/dashboard-admin', [HomeAdminController::class, 'admin'])->name('dashboard-admin');

Route::get('/dashboard-admin/prices', [HomeAdminController::class, 'listPrice'])->name('dashboard-admin.prices');
Route::post('/dashboard-admin/prices', [HomeAdminController::class, 'addPrice'])->name('dashboard-admin.prices.post');
Route::post('/dashboard-admin/prices/{id}', [HomeAdminController::class, 'editPrice'])->name('dashboard-admin.prices.edit');
Route::delete('/dashboard-admin/prices/{id}', [HomeAdminController::class, 'deletePrice'])->name('dashboard-admin.prices.delete');

Route::get('/dashboard-admin/products', [HomeAdminController::class, 'listProducts'])->name('dashboard-admin.products');
Route::post('/dashboard-admin/products', [HomeAdminController::class, 'addProducts'])->name('dashboard-admin.products.post');
Route::post('/dashboard-admin/products/{id}', [HomeAdminController::class, 'editProducts'])->name('dashboard-admin.products.edit');
Route::delete('/dashboard-admin/products/{id}', [HomeAdminController::class, 'deleteProducts'])->name('dashboard-admin.products.delete');

Route::get('/dashboard-admin/orders', [HomeAdminController::class, 'adminOrder'])->name('dashboard-admin.orders');

Route::get('/dashboard-admin/taxes', [HomeAdminController::class, 'listTaxes'])->name('dashboard-admin.taxes');
Route::post('/dashboard-admin/taxes', [HomeAdminController::class, 'addTaxes'])->name('dashboard-admin.taxes.post');
Route::put('/dashboard-admin/taxes/{id}', [HomeAdminController::class, 'editTaxes'])->name('dashboard-admin.taxes.edit');
Route::delete('/dashboard-admin/taxes/{id}', [HomeAdminController::class, 'deleteTaxes'])->name('dashboard-admin.taxes.delete');

Route::get('/dashboard-admin/clients', [HomeAdminController::class, 'adminClient'])->name('dashboard-admin.clients');
Route::get('/dashboard-admin/new-order', [HomeAdminController::class, 'adminNewOrder'])->name('dashboard-admin.new-order');

Route::get('/dashboard-client', [HomeClientController::class, 'index'])->name('dashboard-client');
Route::get('/dashboard-client/new-order', [HomeClientController::class, 'client'])->name('dashboard-client.new-order');
Route::get('/dashboard-client/orders', [HomeClientController::class, 'clientOrders'])->name('dashboard-client.orders');
Route::get('/dashboard-client/profile', [HomeClientController::class, 'clientProfile'])->name('dashboard-client.profile');
