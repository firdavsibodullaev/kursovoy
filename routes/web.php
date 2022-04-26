<?php

use App\Http\Controllers\Web\PhdDoctorController;
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
});


Auth::routes();
