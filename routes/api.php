<?php

use App\Http\Resources\NewsItemResource;
use App\Models\NewsItem;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/newsitems')->group(function () {
    Route::get('/', function () {
        return NewsItemResource::collection(NewsItem::all());
    });

    Route::get('/{id}', function ($id) {
        return new NewsItemResource(NewsItem::findOrFail($id));
    });
});
