<?php
Route::get('/lansia/search', [\App\Http\Controllers\api\SearchController::class, 'searchLansia']);
Route::get('/bayi/search', [\App\Http\Controllers\api\SearchController::class, 'searchLansia']);