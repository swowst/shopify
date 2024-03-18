<?php


use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\UsersController;
use Illuminate\Support\Facades\Route;



Route::get('/login-view', [AdminController::class, 'index'])->name('panel.admin-view');
Route::post('/login/admin', [AdminController::class, 'loginAdmin'])->name('admin-login');




Route::group(['middleware' => ['panelsetting', 'admin'], 'prefix' => 'panel', 'as' => 'panel.'], function (){

    Route::get('/', [DashboardController::class, 'index'])->name('panel.index');

    Route::get('/logout/admin', [AdminController::class, 'logoutAdmin'])->name('admin-logout');


    Route::get('/slider', [SliderController::class, 'index'])->name('slider.index');
    Route::get('/slider/add', [SliderController::class, 'create'])->name('slider.create');
    Route::get('/slider/{id}/edit', [SliderController::class, 'edit'])->name('slider.edit');
    Route::post('/slider/store', [SliderController::class, 'store'])->name('slider.store');
    Route::put('/slider/{id}/update', [SliderController::class, 'update'])->name('slider.update');
    Route::delete('/slider/delete', [SliderController::class, 'destroy'])->name('slider.destroy');
    Route::post('/slider/status/update', [SliderController::class, 'status'])->name('slider.status');




    Route::resource('category',CategoryController::class)->except('destroy');
    Route::delete('/category/delete', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::post('/category/status/update', [CategoryController::class, 'status'])->name('category.status');


    Route::resource('users',UsersController::class)->except('destroy');
    Route::delete('/users/delete', [UsersController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/status/update', [UsersController::class, 'status'])->name('users.status');



    Route::resource('products',ProductController::class)->except('destroy');
    Route::delete('/product/delete', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::post('/product/status/update', [ProductController::class, 'status'])->name('products.status');

    Route::resource('orders',\App\Http\Controllers\Backend\OrderController::class)->except('destroy');
    Route::delete('/orders/delete', [\App\Http\Controllers\Backend\OrderController::class, 'destroy'])->name('orders.destroy');
    Route::post('/orders/status/update', [\App\Http\Controllers\Backend\OrderController::class, 'status'])->name('orders.status');
    Route::get('/orders/{id}/check', [\App\Http\Controllers\Backend\OrderController::class, 'checkOrder'])->name('checkOrder');


    Route::resource('about',AboutController::class)->except('destroy', 'create');
    Route::delete('/about/delete', [AboutController::class, 'destroy'])->name('about.destroy');

    Route::get('/contact/index', [ContactController::class, 'index'])->name('contact.index');
    Route::delete('/contact/delete', [ContactController::class, 'destroy'])->name('contact.destroy');




    Route::resource('setting',SiteSettingController::class)->except('destroy');
    Route::delete('/settings/delete', [SiteSettingController::class, 'destroy'])->name('setting.destroy');

});

Route::get('/about/create', [AboutController::class, 'create'])->name('about.create');

