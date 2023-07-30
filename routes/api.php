<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Categories
Route::group(['prefix' => 'category'], function () {
    Route::get('list', [ApiController::class, 'categoryList']);
    Route::get('list/{id}', [ApiController::class, 'categorySearch']);
    Route::post('create', [ApiController::class, 'categoryCreate']);
    Route::get('delete/{id}', [ApiController::class, 'categoryDelete']);
    Route::post('update', [ApiController::class, 'categoryUpdate']);
});
