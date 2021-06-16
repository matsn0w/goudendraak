<?php

use App\Http\Controllers\Api\MenuCategoryController;
use App\Http\Controllers\Api\MenuItemController;
use App\Http\Controllers\Api\NewsItemController;
use App\Http\Controllers\Api\OrderController;
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

Route::prefix('v1')->group(function() {
    Route::apiResource('newsitems', NewsItemController::class);
    Route::apiResource('menuitems', MenuItemController::class);
    Route::apiResource('menucategories', MenuCategoryController::class);
    Route::apiResource('orders', OrderController::class);

    // Temp
    Route::get('categories', function () {
        return [
            'data' => [
                [
                    'id' => 1,
                    'name' => 'SOEP',
                ],
                [
                    'id' => 2,
                    'name' => 'VOORGERECHT',
                ],
                [
                    'id' => 3,
                    'name' => 'BAMI EN NASI GERECHTEN',
                ],
            ]
        ];
    });
});
