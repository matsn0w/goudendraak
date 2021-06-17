<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashierController;
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

Route::get('/menu/download', [MenuController::class, 'download'])->name('menu.download');

Route::name('auth.')->prefix('/auth')->group(function() {
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::name('admin.')->prefix('/admin')->middleware(['auth', 'role:admin,manager'])->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::get('/news', [NewsController::class, 'admin'])->name('news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');

    Route::get('/menu', [MenuController::class, 'admin'])->name('menu.index');
    Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
    Route::get('/menu/{item}/edit', [MenuController::class, 'edit'])->name('menu.edit');

    Route::get('/menu/categories', [MenuCategoryController::class, 'admin'])->name('menu.categories.index');
    Route::get('/menu/categories/create', [MenuCategoryController::class, 'create'])->name('menu.categories.create');
    Route::get('/menu/categories/{item}/edit', [MenuCategoryController::class, 'edit'])->name('menu.categories.edit');

    Route::get('/users', [UserController::class, 'admin'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{item}/edit', [UserController::class, 'edit'])->name('users.edit');
});

Route::name('cashier.')->prefix('/cashier')->middleware(['auth', 'role:admin,manager,cashier,waiter'])->group(function() {
    Route::get('/', [CashierController::class, 'index'])->name('index');
    Route::get('/payment', [CashierController::class, 'payment'])->middleware('role:admin,manager,cashier')->name('payment');
    Route::get('/dishes', [CashierController::class, 'dishes'])->name('dishes');
    Route::get('/overview', [CashierController::class, 'overview'])->middleware('role:admin,manager')->name('overview');
});
