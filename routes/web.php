<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

//Auth
Route::middleware(['login_auth'])->group(function(){
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth' ])->group(function () {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('auth#dashboard');
    //admin
    Route::middleware(['admin_auth'])->group(function () {
        //Category
        Route::group(['prefix' => 'category'], function () {
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('createPage', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('updatePage/{id}', [CategoryController::class, 'updatePage'])->name('category#updatePage');
            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        });

        // Account
        Route::group(['prefix' => 'account'], function(){
            Route::get('details', [AccountController::class, 'details'])->name('account#details');
            Route::get('updatePage', [AccountController::class, 'updatePage'])->name('account#updatePage');
            Route::post('update/{id}', [AccountController::class, 'update'])->name('account#update');
            Route::get('changePassword', [AccountController::class, 'changePasswordPage'])->name('account#changePasswordPage');
            Route::post('change/password', [AccountController::class, 'changePassword'])->name('account#changePassword');
            Route::get('adminList', [AccountController::class, 'adminList'])->name('account#adminList');
            Route::get('admin/delete/{id}', [AccountController::class, 'delete'])->name('account#adminDelete');
            Route::get('changeRole/{id}', [AccountController::class, 'changeRole'])->name('account#changerole');
            Route::post('role/change/{id}', [AccountController::class, 'roleChange'])->name('account#rolechange');
        });

        //Pizza
        Route::group(['prefix'=>'product'], function(){
            Route::get('list', [ProductController::class, 'list'])->name('product#list');
            Route::get('createPage', [ProductController::class, 'createPage'])->name('product#createPage');
            Route::post('create', [ProductController::class, 'create'])->name('product#create');
            Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product#delete');
            Route::get('details/{id}', [ProductController::class, 'details'])->name('product#details');
            Route::get('updatePage/{id}', [ProductController::class, 'updatePage'])->name('product#updatePage');
            Route::post('update', [ProductController::class, 'update'])->name('product#update');
        });

    });


    //User
    Route::middleware(['user_auth'])->group(function () {
        Route::get('user/customer', function () {
            return view('User.customer');
        })->name('user#customer');
    });
});
