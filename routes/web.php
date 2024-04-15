<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BalitaController;
use App\Http\Controllers\LansiaController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
});
Route::get('/login', [LoginController::class, 'index']);


Route::get('/index', [DashboardController::class, 'index']);

Route::get('/test', function () {
    return view('ketua.test');
});

Route::group(['prefix' => 'kader'], function () {
    Route::get('/', [DashboardController::class, 'indexKader']);

    Route::group(['prefix' => 'balita'], function () {
        Route::get('/', [BalitaController::class, 'index']);
        Route::get('/tambah', [BalitaController::class, 'tambah']);
    });

    Route::group(['prefix' => 'lansia'], function () {
        Route::get('/', [LansiaController::class, 'index']);
        Route::get('/tambah', [LansiaController::class, 'tambah']);
    });
    Route::get('/profile', [ProfileController::class, 'indexKader']);
});

Route::group(['prefix' => 'ketua'], function () {
    Route::get('/', [DashboardController::class, 'indexKetua']);
    Route::get('/profile', [ProfileController::class, 'indexKetua']);
});
