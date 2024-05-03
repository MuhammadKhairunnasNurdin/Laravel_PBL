<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Shared\AuthController;

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
    }
);
