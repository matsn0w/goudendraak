<?php

use App\Http\Controllers\AuthController;
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
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/news', 'pages.news')->name('news');

Route::name('auth.')->prefix('/auth')->group(function() {
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::name('admin.')->prefix('/admin')->middleware('auth')->group(function() {
    Route::get('/', function () {
        return 'admin';
    })->name('index');

    Route::get('/news', [NewsController::class, 'admin'])->name('news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
});
