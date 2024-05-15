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

// Route::middleware(['auth'])->group(function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    });
// });

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes

// Manager (admin)
Route::group(['middleware' => ['role:86efe04b-8be4-4c70-a240-fe9624d89371']], function () {
   Route::get('/dashboard', function () {
       return view ('dashboard');
   });
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

// Cashier (basic)
Route::group(['middleware' => ['role:eff3a740-b777-48dc-8c04-78893ba6a50b,86efe04b-8be4-4c70-a240-fe9624d89371']], function () {
   Route::get('/cashier', [CashierController::class, 'index']);
   Route::post('/bill_preview', [CashierController::class, 'createBill'])->name('bill_preview');
   Route::get('/bills', [CashierController::class, 'index']);

   Route::get('/sales', [SalesController::class, 'index']);
});

Route::get('/unauthorized', function () {
   return view('login/unauthorized_access');
});

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

Route::view('/register', 'register/register');
Route::post('/register', [UserController::class, 'register']);

Route::get('/register_error', function () {
   return view('register/register_error');
})->name('register_error');

// Route::view('/dashboard', 'dashboard');


// Inventory Routes
// Route::get('/inventory', [ItemController::class, 'index']);
// Route::post('/info', [ItemController::class, 'show_individual']);


// Cashier Routes
// CHANGE BILL PREVIEW METHOD
// Route::get('/cashier', [CashierController::class, 'index']);
// Route::post('/bill_preview', [CashierController::class, 'createBill'])->name('bill_preview');
// Route::get('/bills', [CashierController::class, 'viewBills']);

// Sales Routes
Route::get('/sales', [SalesController::class, 'index']);
