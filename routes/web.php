<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AllergenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'pages.home')->name('home');
Route::view('/menu', 'pages.menu')->name('menu');
Route::view('/news', 'pages.news')->name('news');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/order', 'pages.order')->name('order');

Route::get('/menu/download', [MenuController::class, 'download'])->name('menu.download');

Route::post('/lang', [LangController::class, 'switch'])->name('lang.switch');

Route::name('auth.')->prefix('/auth')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::name('admin.')->prefix('/admin')->middleware(['auth', 'role:admin,manager'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::resource('/news', NewsController::class)->only('index', 'create', 'edit');
    Route::resource('/menu', MenuController::class)->only('index', 'create', 'edit');
    Route::name('menu')->resource('/menu/categories', MenuCategoryController::class)->only('index', 'create', 'edit');
    Route::name('menu')->resource('/menu/allergens', AllergenController::class)->only('index', 'create', 'edit');
    Route::resource('/menu', MenuController::class)->only('index', 'create', 'edit');
    Route::resource('/users', UserController::class)->only('index', 'create', 'edit');
});

Route::name('cashier.')->prefix('/cashier')->middleware(['auth', 'role:admin,manager,cashier,waiter'])->group(function () {
    Route::get('/', [CashierController::class, 'index'])->name('index');
    Route::get('/payment', [CashierController::class, 'payment'])->middleware('role:admin,manager,cashier')->name('payment');
    Route::get('/orders', [CashierController::class, 'orders'])->name('orders');
    Route::get('/dishes', [CashierController::class, 'dishes'])->name('dishes');
    Route::get('/overview', [CashierController::class, 'overview'])->middleware('role:admin,manager')->name('overview');
});
