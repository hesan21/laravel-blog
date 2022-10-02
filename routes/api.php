<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BlogAPIController;
use App\Http\Controllers\API\UserAPIController;
use Illuminate\Http\Request;
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

Route::middleware('guest')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/{user}', [UserAPIController::class, 'show'])
        ->name('api-user.detail');

    Route::prefix('blog')->group(function() {
        Route::get('list', [BlogAPIController::class , 'index'])
            ->name('api-blog.index');

        Route::post('store', [BlogAPIController::class , 'store'])
            ->name('api-blog.store');

        Route::patch('update/{blog}', [BlogAPIController::class , 'update'])
            ->name('api-blog.update');

        Route::delete('delete/{blog}', [BlogAPIController::class , 'delete'])
            ->name('api-blog.delete');
    });
});
