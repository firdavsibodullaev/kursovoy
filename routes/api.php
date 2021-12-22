<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\FacultyController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
        });
    });
    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('user')->name('user.')->group(function () {
            Route::get('', [UserController::class, 'index']);
            Route::get('posts', [UserController::class, 'posts']);
            Route::get('{user}', [UserController::class, 'show']);
            Route::post('', [UserController::class, 'store']);
            Route::put('{user}', [UserController::class, 'update']);
            Route::delete('{user}', [UserController::class, 'destroy']);
        });
    });

    Route::prefix('faculty')->group(function () {
        Route::get('', [FacultyController::class, 'index']);
        Route::get('{faculty}', [FacultyController::class, 'show']);
    });

});

