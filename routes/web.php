<?php

use App\Http\Controllers\Web\DscDoctorController;
use App\Http\Controllers\Web\PhdDoctorController;
use App\Http\Controllers\Web\ScientificArticleCitationController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Auth;
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


Route::middleware('auth')->group(function () {

    Route::view('/', 'index')->name('index');
    Route::middleware('is_admin')->group(function () {
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('', [UserController::class, 'index'])->name('index');
            Route::get('search', [UserController::class, 'search'])->name('search');
            Route::get('create', [UserController::class, 'create'])->name('create');
            Route::post('', [UserController::class, 'store'])->name('store');
            Route::get('edit/{user:username}', [UserController::class, 'edit'])->whereAlphaNumeric('user')->name('edit');
            Route::put('{user:username}', [UserController::class, 'update'])->whereAlphaNumeric('user')->name('update');
            Route::delete('{user:username}', [UserController::class, 'destroy'])->where('user', '[a-zA-Z0-9\.]+')->name('delete');
        });

        Route::prefix('phd-doctors')->name('phd_doctors.')->group(function () {
            Route::get('', [PhdDoctorController::class, 'index'])->name('index');
            Route::get('create', [PhdDoctorController::class, 'create'])->name('create');
            Route::post('', [PhdDoctorController::class, 'store'])->name('store');
            Route::get('edit/{phdDoctor}', [PhdDoctorController::class, 'edit'])->whereNumber('phdDoctor')->name('edit');
            Route::put('{phdDoctor}', [PhdDoctorController::class, 'update'])->whereNumber('phdDoctor')->name('update');
            Route::delete('{phdDoctor}', [PhdDoctorController::class, 'destroy'])->whereNumber('phdDoctor')->name('delete');
        });

        Route::prefix('dsc-doctors')->name('dsc_doctors.')->group(function () {
            Route::get('', [DscDoctorController::class, 'index'])->name('index');
            Route::get('create', [DscDoctorController::class, 'create'])->name('create');
            Route::post('', [DscDoctorController::class, 'store'])->name('store');
            Route::get('edit/{dScDoctor}', [DscDoctorController::class, 'edit'])->whereNumber('dScDoctor')->name('edit');
            Route::put('{dScDoctor}', [DscDoctorController::class, 'update'])->whereNumber('dScDoctor')->name('update');
            Route::delete('{dScDoctor}', [DscDoctorController::class, 'destroy'])->whereNumber('dScDoctor')->name('delete');
        });

    });

    Route::prefix('article-citation')->name('article_citation.')->group(function () {
        Route::get('', [ScientificArticleCitationController::class, 'index'])->name('index');
        Route::get('not-confirmed', [ScientificArticleCitationController::class, 'notConfirmed'])
            ->middleware('is_admin')
            ->name('not_confirmed');
        Route::get('create', [ScientificArticleCitationController::class, 'create'])->name('create');
        Route::post('', [ScientificArticleCitationController::class, 'store'])->name('store');
        Route::get('edit/{scientificArticleCitation}', [ScientificArticleCitationController::class, 'edit'])
            ->whereNumber('scientificArticleCitation')
            ->name('edit');
        Route::put('{scientificArticleCitation}', [ScientificArticleCitationController::class, 'update'])
            ->whereNumber('scientificArticleCitation')
            ->name('update');
        Route::post('confirm/{scientificArticleCitation}', [ScientificArticleCitationController::class, 'confirm'])
            ->middleware('is_admin')
            ->whereNumber('scientificArticleCitation')
            ->name('confirm');
        Route::delete('{scientificArticleCitation}', [ScientificArticleCitationController::class, 'destroy'])
            ->whereNumber('scientificArticleCitation')
            ->name('delete');
    });
});


Auth::routes();
