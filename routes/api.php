<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\DScDoctorsController;
use App\Http\Controllers\Api\FacultyController;
use App\Http\Controllers\Api\ListController;
use App\Http\Controllers\Api\PhdDoctorController;
use App\Http\Controllers\Api\ScientificArticleCitationController;
use App\Http\Controllers\Api\ScientificArticleController;
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

        // Пользователи
        Route::prefix('user')->name('user.')->group(function () {
            Route::get('', [UserController::class, 'index']);
            Route::get('posts', [UserController::class, 'posts']);
            Route::get('list', [UserController::class, 'list']);
            Route::get('{user}', [UserController::class, 'show']);
            Route::post('', [UserController::class, 'store']);
            Route::put('{user}', [UserController::class, 'update']);
            Route::delete('{user}', [UserController::class, 'destroy']);
        });

        // DSc doctor

        Route::prefix('dsc-doctor')->name('dsc_doctor.')->group(function () {
            Route::get('', [DScDoctorsController::class, 'index']);
            Route::get('{dScDoctor}', [DScDoctorsController::class, 'show']);
            Route::post('', [DScDoctorsController::class, 'store']);
            Route::put('{dScDoctor}', [DScDoctorsController::class, 'update']);
            Route::delete('{dScDoctor}', [DScDoctorsController::class, 'destroy']);
        });

        // Phd doctor

        Route::prefix('phd-doctor')->name('phd_doctor.')->group(function () {
            Route::get('', [PhdDoctorController::class, 'index']);
            Route::get('{phdDoctor}', [PhdDoctorController::class, 'show']);
            Route::post('', [PhdDoctorController::class, 'store']);
            Route::put('{phdDoctor}', [PhdDoctorController::class, 'update']);
            Route::delete('{phdDoctor}', [PhdDoctorController::class, 'destroy']);
        });

        // Цитаты статьи
        Route::prefix('scientific-article-citation')->name('scientific_article_citation')->group(function () {
            Route::get('confirmation', [ScientificArticleCitationController::class, 'getNotConfirmedArticlesList']);
            Route::get('', [ScientificArticleCitationController::class, 'index']);
            Route::get('{scientificArticleCitation}', [ScientificArticleCitationController::class, 'show']);
            Route::post('', [ScientificArticleCitationController::class, 'store']);
            Route::post('confirm/{scientificArticleCitation}', [ScientificArticleCitationController::class, 'confirm']);
            Route::put('{scientificArticleCitation}', [ScientificArticleCitationController::class, 'update']);
            Route::delete('{scientificArticleCitation}', [ScientificArticleCitationController::class, 'destroy']);
        });

        Route::prefix('scientific-article')->name('scientific_article')->group(function () {
            Route::get('', [ScientificArticleController::class, 'index']);
            Route::get('confirmation', [ScientificArticleController::class, 'getNotConfirmedArticlesList']);
            Route::get('{scientificArticle}', [ScientificArticleController::class, 'show']);
            Route::post('', [ScientificArticleController::class, 'store']);
            Route::post('confirm/{scientificArticle}', [ScientificArticleController::class, 'confirm']);
            Route::put('{scientificArticle}', [ScientificArticleController::class, 'update']);
            Route::delete('{scientificArticle}', [ScientificArticleController::class, 'destroy']);
        });

        Route::get('magazines', [ListController::class, 'magazines']);
        Route::get('languages', [ListController::class, 'languages']);


    });

    Route::prefix('faculty')->group(function () {
        Route::get('', [FacultyController::class, 'index']);
        Route::get('{faculty}', [FacultyController::class, 'show']);
    });

});

