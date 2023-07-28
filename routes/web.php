<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ContactController;
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
            Route::get('userList', [AccountController::class, 'userList'])->name('account#userList');
            Route::get('admin/delete/{id}', [AccountController::class, 'delete'])->name('account#adminDelete');
            Route::get('role/change/{id}', [AccountController::class, 'roleChange'])->name('account#rolechange');
            Route::get('user/delete/{id}', [AccountController::class, 'userDelete'])->name('account#userDelete');
            Route::get('upgrade/admin/{id}', [AccountController::class, 'upgrade'])->name('account#upgrade');
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

        Route::group(['prefix'=>'orders'], function(){
            Route::get('list', [OrderController::class, 'list'])->name('orders#list');
            Route::get('details/{code}', [OrderController::class, 'details'])->name('orders#details');
            Route::get('change/status/{code}/{status}', [OrderController::class, 'changeStatus'])->name('orders#changeStatus');
            Route::get('filter', [OrderController::class, 'filter'])->name('orders#filter');
            Route::get('customer/list/{id}', [OrderController::class, 'customerList'])->name('orders#customerList');
        });

        Route::group(['prefix'=>'contact'], function(){
            Route::get('list', [ContactController::class, 'list'])->name('contact#list');
        });

    });


    //User
    Route::middleware(['user_auth'])->group(function () {
        Route::get('user/home', [UserController::class, 'home'])->name('user#home');
        Route::get('user/home/filter/{id}', [UserController::class, 'filter'])->name('user#filter');
        Route::get('user/home/sort', [AjaxController::class, 'sorting'])->name('user#sort');
        Route::get('pizza/details/{id}', [UserController::class, 'pizzaDetails'])->name('pizza#details');
        Route::get('pizza/view', [AjaxController::class, 'increaseView'])->name('pizza#viewCount');

        Route::group(['prefix'=>'user/account'], function(){
            Route::get('details', [UserController::class, 'details'])->name('useraccount#details');
            Route::get('updatePage', [UserController::class, 'updatePage'])->name('useraccount#updatePage');
            Route::post('update/{id}', [UserController::class, 'update'])->name('useraccount#update');
            Route::get('changePassword', [UserController::class, 'changePasswordPage'])->name('useraccount#changePasswordPage');
            Route::post('password/change', [UserController::class, 'changePassword'])->name('useraccount#changePassword');
        });

        Route::group(['prefix'=>'cart'], function(){
            Route::get('details', [CartController::class, 'details'])->name('cart#details');
            Route::get('summary', [CartController::class, 'summary'])->name('cart#summary');
            Route::get('update', [CartController::class, 'update'])->name('cart#update');
            Route::get('delete', [CartController::class, 'delete'])->name('cart#delete');
            Route::get('delete/all', [CartController::class, 'deleteAll'])->name('cart#deleteAll');
            Route::get('add/{id}', [CartController::class, 'add'])->name("cart#add");
        });

        Route::group(['prefix' => 'order'], function(){
            Route::get('add', [OrderController::class, 'addOrder'])->name('order#addOrder');
            Route::get('history', [OrderController::class, 'history'])->name('order#history');
            Route::get('details/{code}', [OrderController::class, 'showDetails'])->name('order#details');
        });

        Route::group(['prefix'=>'rating'], function(){
            Route::post('rate', [RatingController::class, 'rate'])->name('rating#rate');
        });

        Route::group(['prefix'=>'contact'], function(){
           Route::get('message', [ContactController::class, 'message'])->name('contact#message');
           Route::post('send/message', [ContactController::class, 'sendMessage'])->name('contact#sendMessage');
           Route::get('history/{id}', [ContactController::class, 'history'])->name('contact#history');
        });

    });
});
