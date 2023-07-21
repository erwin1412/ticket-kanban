<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DashboadController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Web Admin
Route::get('/admin/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/admin/login', [AuthController::class, 'authenticate']);
Route::post('/admin/logout', [AuthController::class, 'logout']);

Route::middleware(['auth', 'check.role.admin:1'])->group(function () {
    Route::get('/admin/dashboard', [DashboadController::class, 'index']);

    Route::get('/admin/categories/print', [CategoryController::class, 'print']);
    Route::resource('/admin/categories', CategoryController::class)->except(['show']);

    Route::get('/admin/products/print', [ProductController::class, 'print']);
    Route::resource('/admin/products', ProductController::class)->except(['show']);

    Route::resource('/admin/banners', BannerController::class)->except(['show']);

    Route::get('/admin/customers', [CustomerController::class, 'index']);
    Route::get('/admin/customers/print', [CustomerController::class, 'print']);
    Route::delete('/admin/customers/{id}', [CustomerController::class, 'destroy']);

    Route::get('/admin/orders', [OrderController::class, 'index']);
    Route::get('/admin/orders/print', [OrderController::class, 'print']);
    Route::get('/admin/orders/detail/{orderNumber}', [OrderController::class, 'detail']);
    Route::get('/admin/orders/print/{orderNumber}', [OrderController::class, 'printDetail']);

    Route::get('/admin/profile', [ProfileController::class, 'index']);
    Route::post('/admin/profile', [ProfileController::class, 'changeProfile']);
    Route::post('/admin/profile/change-password', [ProfileController::class, 'changePassword']);
});

// Web User
Route::get('/', [HomeController::class, 'index']);

Route::get('/login', [AuthUserController::class, 'login']);
Route::post('/login', [AuthUserController::class, 'postLogin']);

Route::get('/register', [AuthUserController::class, 'register']);
Route::post('/register', [AuthUserController::class, 'postRegister']);

Route::get('/logout', [AuthUserController::class, 'logout']);

Route::group(['middleware' => ['check.is.login.user']], function () {
    Route::get('/category/{name}', [HomeController::class, 'category']);
    Route::get('/detail/{slug}', [HomeController::class, 'detail']);

    Route::get('/user/purchase', [UserController::class, 'purchase']);
    Route::get('/user/purchase/detail/{orderNumber}', [UserController::class, 'detail']);
    Route::get('/user/purchase/print/{orderNumber}', [UserController::class, 'print']);

    Route::get('/cart', [CartController::class, 'index']);
    Route::get('/cart/add/{slug}', [CartController::class, 'save']);
    Route::get('/cart/min/{slug}', [CartController::class, 'min']);
    Route::get('/cart/delete/{slug}', [CartController::class, 'delete']);

    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::get('/provinces/{id}/cities', [CheckoutController::class, 'getCities']);
    Route::post('/checkout/checkcost', [CheckoutController::class, 'checkCost']);
    Route::post('/checkout/pay', [CheckoutController::class, 'pay']);
});
