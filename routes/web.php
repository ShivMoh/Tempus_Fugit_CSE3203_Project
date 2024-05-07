<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonkeyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
   return view("welcome"); 
});

Route::get('/monkey', [MonkeyController::class, 'index']);

// start supplier routes

// Route::view('/supplier', 'supplier/supplier');
Route::get('/supplier', [SupplierController::class, 'index']);
Route::post('/supplier', [SupplierController::class, 'index']);
Route::post('/request-form', [SupplierController::class, 'get_request_form']);
Route::post('/order-item', [SupplierController::class, 'order_item']);
Route::post('/review', [SupplierController::class, 'review']);

// Route::post('/supplier', [SupplierController::class, 'test']);

// end supplier routes


Route::view('/register', 'register');
Route::post('/register', [UserController::class, 'register']);


Route::view('/login', 'login')->name('login');
Route::post('/login', [UserController::class, 'login']);

Route::view('/dashboard', 'dashboard');


// Inventory Routes
Route::get('/inventory', [ItemController::class, 'index']);