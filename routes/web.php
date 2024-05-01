<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonkeyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;

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
// Route::post('/supplier', [SupplierController::class, 'test']);

// end supplier routes


Route::view('/register', 'register');
Route::post('/register', [UserController::class, 'register']);


Route::view('/login', 'login')->name('login');
Route::post('/login', [UserController::class, 'login']);

Route::view('/dashboard', 'dashboard');