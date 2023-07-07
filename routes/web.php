<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

Route::redirect('/', 'loginPage');
Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('auth#dashboard');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified' ])->group(function () {
    //admin
    Route::middleware(['admin_auth'])->group(function () {
        //Category
        Route::group(['prefix' => 'category'], function () {
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');
        });

    });


    //User
    Route::middleware(['user_auth'])->group(function () {
        Route::get('user/customer', function () {
            return view('User.customer');
        })->name('user#customer');
    });
});
