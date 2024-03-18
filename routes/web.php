<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PageHomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => 'sitesetting'], function (){


    Route::get('/', [PageHomeController::class, 'index'])->name('anasayfa');
    Route::get('/account', [PageController::class, 'account'])->name('account');
    Route::get('/register', [PageController::class, 'registerView'])->name('registerView');

    Route::post('/login', [AuthController::class, 'login'])->name('user-login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('user-logout');

    Route::post('/register/user', [AuthController::class, 'register'])->name('user-register');


    Route::post('/filterItems', [AjaxController::class, 'filterItems'])->name('filterItems');





    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::get('/product/{slug}', [PageController::class, 'detail'])->name('detail');

    Route::get('/shop', [PageController::class, 'shop'])->name('shop');


    Route::get('/sale/products', [PageController::class, 'saleProducts'])->name('sale-products');

    Route::get('/men/{slug?}', [PageController::class, 'shop'])->name('kisishop');
    Route::get('/women/{slug?}', [PageController::class, 'shop'])->name('qadinshop');
    Route::get('/kids/{slug?}', [PageController::class, 'shop'])->name('usaqshop');

    Route::post('/contact-form', [AjaxController::class, 'contactForm'])->name('contact-form');

    Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');


    Route::post('/add-cart', [CartController::class, 'add'])->name('add-cart');
    Route::post('/remove-cart', [CartController::class, 'remove'])->name('remove-cart');
    Route::post('/add-new-qty', [CartController::class, 'newQty'])->name('newQty');


    Route::post('/check/coupon', [CartController::class, 'checkCoupon'])->name('checkCoupon');
    Route::post('/cart/save', [CartController::class, 'cartSave'])->name('cart-save');



});



