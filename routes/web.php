<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NewsController;
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

Route::name('auth.')->prefix('/auth')->group(function() {
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::name('admin.')->prefix('/admin')->middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::get('/news', [NewsController::class, 'admin'])->name('news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');

    Route::get('/menu', [MenuController::class, 'admin'])->name('menu.index');
    Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
    Route::get('/menu/{item}/edit', [MenuController::class, 'edit'])->name('menu.edit');
});

Route::name('cashier.')->prefix('/cashier')->middleware(['auth', 'role:admin,cashier'])->group(function() {
    Route::get('/', [CashierController::class, 'index'])->name('index');
    Route::get('/dishes', [CashierController::class, 'dishes'])->name('dishes');
    Route::get('/overview', [CashierController::class, 'overview'])->name('overview');
});
