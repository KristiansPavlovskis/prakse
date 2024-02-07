<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return view('welcome');
});

Route::get('/phpmyadmin', function () {
    return redirect('http://localhost:8001');
});

route::get('/product', [ProductController::class, 'index'])->name('product.index');
route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
route::post('/product', [ProductController::class, 'store'])->name('product.store');
route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
route::put('/product/{product}/update', [ProductController::class, 'update'])->name('product.update');
route::delete('/product/{product}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');