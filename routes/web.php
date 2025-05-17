<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/signin-submit', [AuthController::class, 'login'])->name('signin.submit');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/signup-submit', [AuthController::class, 'register'])->name('signup.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/', function () {
    return view('Pages.Dashboard.dashboard');
})->middleware('auth')->name('dashboard');



Route::middleware('auth')->group(function () {

    // brands Route
    Route::get('/brands/add', [BrandController::class, 'create'])->name('brands.create');
    Route::post('/brands/store', [BrandController::class, 'store'])->name('brands.store');
    Route::get('/brands/list', [BrandController::class, 'index'])->name('brands.index');
    Route::get('/brands/edit/{id}', [BrandController::class, 'edit'])->name('brands.edit');
    Route::post('/brands/update/{id}', [BrandController::class, 'update'])->name('brands.update');
    Route::post('/brands/delete/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');

    // Colors Route
    Route::get('/colors/add', [ColorController::class, 'create'])->name('colors.create');
    Route::post('/colors/store', [ColorController::class, 'store'])->name('colors.store');
    Route::get('/colors/list', [ColorController::class, 'index'])->name('colors.index');
    Route::get('/colors/edit/{id}', [ColorController::class, 'edit'])->name('colors.edit');
    Route::post('/colors/update/{id}', [ColorController::class, 'update'])->name('colors.update');
    Route::post('/colors/delete/{id}', [ColorController::class, 'destroy'])->name('colors.destroy');



    // Sizes Route
    Route::get('/sizes/add', [SizeController::class, 'create'])->name('sizes.create');
    Route::post('/sizes/store', [SizeController::class, 'store'])->name('sizes.store');
    Route::get('/sizes/list', [SizeController::class, 'index'])->name('sizes.index');
    Route::get('/sizes/edit/{id}', [SizeController::class, 'edit'])->name('sizes.edit');
    Route::post('/sizes/update/{id}', [SizeController::class, 'update'])->name('sizes.update');
    Route::post('/sizes/delete/{id}', [SizeController::class, 'destroy'])->name('sizes.destroy');

    // Logos Route
    Route::get('/logos/add', [LogoController::class, 'create'])->name('logos.create');
    Route::post('/logos/store', [LogoController::class, 'store'])->name('logos.store');
    Route::get('/logos/list', [LogoController::class, 'index'])->name('logos.index');
    Route::get('/logos/edit/{id}', [LogoController::class, 'edit'])->name('logos.edit');
    Route::post('/logos/update/{id}', [LogoController::class, 'update'])->name('logos.update');
    Route::post('/logos/delete/{id}', [LogoController::class, 'destroy'])->name('logos.destroy');

    Route::get('/product/add', function (){
        return view('Pages.Product.add_product');
    });
    Route::get('/product/list', function (){
        return view('Pages.Product.list_product');
    });

    // route product
    Route::get('/product/list', [ProductController::class, 'index'])->name('product.list');
    Route::get('/product/add', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/add', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::post('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');

});
