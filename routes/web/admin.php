<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Shared\AuthController;
use App\Http\Controllers\Shared\DashboardController;
use App\Http\Controllers\Admin\PendudukController;


/*
|--------------------------------------------------------------------------
| Web for admin role
|--------------------------------------------------------------------------
|
| we separate web route for role admin to make web routes in web.php more
| clean and easy to maintain admin route in here
|
*/
Route::group([
    'middleware' => ['auth', 'checkLevel:admin'],
    'prefix' => 'admin'
    ], function () {
        /**
         * route for logout process
         */
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->name('admin.logout');
        Route::get('/', [DashboardController::class, 'indexAdmin']);
        Route::get('/penduduk', [PendudukController::class, 'index']);
        Route::get('/penduduk/create', [PendudukController::class, 'create']);
    }
);