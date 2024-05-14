<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonkeyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CashierController;

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
   return redirect("/login"); 
});

Route::middleware(['auth'])->group(function () {
   Route::get('/dashboard', function () {
       return view('dashboard');
   });
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/monkey', [MonkeyController::class, 'index']);

// start supplier routes

// Route::view('/supplier', 'supplier/supplier');
Route::get('/supplier', [SupplierController::class, 'index']);
Route::post('/supplier', [SupplierController::class, 'index']);
Route::post('/request-form', [SupplierController::class, 'get_request_form']);
Route::get('/request-form', [SupplierController::class, 'get_request_form']);
Route::post('/order-item', [SupplierController::class, 'order_item']);
Route::post('/review', [SupplierController::class, 'review']);
Route::get('/orders', [SupplierController::class, 'view_orders']);
Route::post('/view-bill', [SupplierController::class, 'view_bill']);
Route::post('/mark-as-received', [SupplierController::class, 'mark_as_received']);

// Route::post('/supplier', [SupplierController::class, 'test']);

// end supplier routes

// Route::get('/dashboard', function () {
//    return view('dashboard');
// })->middleware('auth');

Route::post('/stay-logged-in', [AuthController::class, 'stayLoggedIn'])->name('stay-logged-in');

Route::view('/register', 'register');
Route::post('/register', [UserController::class, 'register']);

// Route::view('/dashboard', 'dashboard');


// Inventory Routes
Route::get('/inventory', [ItemController::class, 'index']);


// Cashier Routes
Route::get('/cashier', [CashierController::class, 'index']);