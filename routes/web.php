<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonkeyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\DashboardController;

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

Route::get('/login', function () {
   return view('login/login')->with('authorizationLink', '/authorization');
})->name('login');

Route::get('/authorization', [AuthController::class, 'showAuthorizationForm'])->name('authorization');
Route::post('/authorization', [AuthController::class, 'authorizeRegistration']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes

// Manager (admin)
Route::group(['middleware' => ['role:86efe04b-8be4-4c70-a240-fe9624d89371']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


   Route::get('/inventory', [ItemController::class, 'index']);
   Route::post('/info', [ItemController::class, 'show_individual']);
   Route::get('/add-new', [ItemController::class, 'add_new']);
   Route::post('/add-new', [ItemController::class, 'add_new']);
   Route::post('/confirm', [ItemController::class, 'store_item']);
   Route::view('/supplier', 'supplier/supplier');
   Route::get('/supplier', [SupplierController::class, 'index']);
   Route::post('/supplier', [SupplierController::class, 'index']);
   Route::post('/request-form', [SupplierController::class, 'get_request_form']);
   Route::get('/request-form', [SupplierController::class, 'get_request_form']);
   Route::post('/order-item', [SupplierController::class, 'order_item']);
   Route::post('/review', [SupplierController::class, 'review']);
   Route::get('/orders', [SupplierController::class, 'view_orders']);
   Route::post('/view-bill', [SupplierController::class, 'view_bill']);
   Route::post('/mark-as-received', [SupplierController::class, 'mark_as_received']);
});

// Cashier and Manager can do this
Route::group(['middleware' => ['role:eff3a740-b777-48dc-8c04-78893ba6a50b,86efe04b-8be4-4c70-a240-fe9624d89371']], function () {
   Route::get('/cashier', [CashierController::class, 'index'])->name('cashier');
   Route::post('/bill_preview', [CashierController::class, 'createBill'])->name('bill_preview');
   Route::post('/bill_confirmed', [CashierController::class, 'confirmBill'])->name('bill_confirmed');
   Route::post('/bill_view', [CashierController::class, 'viewBill'])->name('bill_view');

   Route::get('/bill_success', function () {
       return view('bill_success');
   })->name('bill_success');
   Route::get('/customer_error', [CashierController::class, 'customerError'])->name('customer_error');
   Route::get('/bills', [CashierController::class, 'viewBills'])->name('bills');
   
   Route::post('/sales', [SalesController::class, 'index'])->name('sales');


   Route::get('/sales', [SalesController::class, 'index']);
});

Route::get('/unauthorized', function () {
   return view('login/unauthorized_access');
});

Route::view('/register', 'register/register');
Route::post('/register', [UserController::class, 'register']);

Route::get('/register_error', function () {
   return view('register/register_error');
})->name('register_error');