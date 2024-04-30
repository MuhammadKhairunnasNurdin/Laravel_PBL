<?php

use App\Http\Controllers\ArtikelResource;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BayiResource;
use App\Http\Controllers\DataTablesController;
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
/**
 * Routes for non-authenticate user
 */
Route::get('/', [PromosiController::class, 'landingpage']);
Route::get('/profil', [PromosiController::class, 'profil'])->name('profil');
Route::get('/jadwal', [PromosiController::class, 'jadwal']);
Route::post('/jadwal', [DataTablesController::class, 'list'])->name('jadwal.list');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.auth');

/**
 * Group route for authenticate user
 */
Route::group(['middleware' => ['auth']], function () {

    /**
     * User Admin
     */
    Route::group(['middleware' => ['checkLevel:admin'], 'prefix' => 'admin'], function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->name('admin.logout');
    });

    /**
     * User Kader
     */
    Route::group(['middleware' => ['checkLevel:kader'], 'prefix' => 'kader'], function () {
        Route::get('/', [DashboardController::class, 'indexKader'])->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'indexKader'])->name('kader.profile');
        Route::post('/profile', [ProfileController::class, 'update'])->name('kader.profile.update');

        Route::resource('bayi', BayiResource::class);
        Route::post('bayi/list', [DataTablesController::class, 'list'])->name('bayi.list');
        Route::get('bayi/data/{id}', [BayiResource::class, 'getData'])->name('bayi.data');
        Route::get('bayi/{id}', [BayiResource::class, 'edit'])->name('bayi.edit');
        Route::resource('lansia', LansiaResource::class);
        Route::post('lansia/list', [DataTablesController::class, 'list'])->name('lansia.list');

        Route::group(['prefix' => 'informasi'], function () {
            Route::get('/', InformasiController::class);

            Route::resource('kegiatan', KegiatanResource::class)->except('show');
            Route::post('kegiatan/list', [DataTablesController::class, 'list'])->name('kegiatan.list');
            Route::resource('artikel', ArtikelResource::class);
        });

        Route::post('/logout', [AuthController::class, 'logout'])->name('kader.logout');
    });

    /**
     * User Ketua
     */
    Route::group(['middleware' => 'checkLevel:ketua', 'prefix' => 'ketua'], function () {
        Route::get('/', [DashboardController::class, 'indexKetua'])->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'indexKetua'])->name('ketua.profile');
        Route::post('/profile', [ProfileController::class, 'update'])->name('ketua.profile.update');

        Route::group(['prefix' => 'bantuan'], function () {
            Route::get('/', [BantuanController::class, 'index']);
            Route::get('/tambah', [BantuanController::class, 'tambah']);
        });
        Route::group(['prefix' => 'penerima'], function () {
            Route::get('/', [PenerimaController::class, 'index']);
            Route::get('/tambah', [PenerimaController::class, 'tambah']);
        });

        Route::post('/logout', [AuthController::class, 'logout'])->name('ketua.logout');
    });
});
