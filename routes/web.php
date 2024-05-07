<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/owner-signup', [AuthController::class, 'ownerSignup']);
Route::post('/owner-login', [AuthController::class, 'ownerLogin']);
Route::post('/manager-signup', [AuthController::class, 'managerSignup']);
Route::post('/manager-login', [AuthController::class, 'managerLogin']);


// Owner routes
Route::post('/add-item', [OwnerController::class, 'addItem'])->middleware('owner');
Route::post('/add-customer', [OwnerController::class, 'addCustomer'])->middleware('owner');

// Cashier routes
Route::delete('/remove-item/{id}', [CashierController::class, 'removeItem'])->middleware('cashier');
Route::put('/edit-item/{id}', [CashierController::class, 'editItem'])->middleware('cashier');

// Manager routes
Route::put('/update-customer/{id}', [ManagerController::class, 'updateCustomer'])->middleware('manager');
Route::delete('/delete-customer/{id}', [ManagerController::class, 'deleteCustomer'])->middleware('manager');
