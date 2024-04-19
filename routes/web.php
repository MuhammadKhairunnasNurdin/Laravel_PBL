<?php

use App\Http\Controllers\ArtikelResource;
use App\Http\Controllers\BayiResource;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KegiatanResource;
use App\Http\Controllers\LansiaResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BantuanController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromosiController;

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
Route::get('/', [PromosiController::class, 'landingpage']);
Route::get('/profil', [PromosiController::class, 'profil'])->name('profil');
Route::get('/jadwal', [PromosiController::class, 'jadwal']);
//Route::get('login', [LoginController::class, 'index'])->name('login');
//Route::post('login', [LoginController::class, 'authenticator'])->name('login.auth');

//Route::group(['middleware' => ['auth']], function () {

    /**
     * User Admin
     */
//    Route::group(['middleware' => ['CheckUserLevel:admin']], function () {
//        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
//    });

    /**
     * User Kader
     */
//    Route::group(['middleware' => ['CheckUserLevel:kader']], function () {
        Route::resource('bayi', BayiResource::class);
        Route::get('/kader', [DashboardController::class, 'indexKader'])->name('kader');
//        Route::get('/', [DashboardController::class, 'indexKader'])->name('kader');
        Route::get('/profile', [ProfileController::class, 'indexKader']);
        Route::resource('lansia', LansiaResource::class);

        Route::group(['prefix' => 'info'], function () {
            Route::get('/', InformasiController::class);
            Route::resource('kegiatan', KegiatanResource::class)->except('show');
            Route::resource('artikel', ArtikelResource::class);
        });

//        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
//    });

    /**
     * User Ketua
     */
//    Route::group(['middleware' => 'CheckUserLevel:ketua', 'prefix' => 'ketua'], function () {
        Route::get('/', [DashboardController::class, 'indexKetua'])->name('ketua');
        Route::get('/profile', [ProfileController::class, 'indexKetua']);

        Route::group(['prefix' => 'bantuan'], function () {
            Route::get('/', [BantuanController::class, 'index']);
            Route::get('/tambah', [BantuanController::class, 'tambah']);
        });
        Route::group(['prefix' => 'penerima'], function () {
            Route::get('/', [PenerimaController::class, 'index']);
            Route::get('/tambah', [PenerimaController::class, 'tambah']);
        });

//        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
//    });
//});
