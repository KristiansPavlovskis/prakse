<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\TodoController;

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
    return redirect()->route('todos.index');
})->name('home');


Route::get('/phpmyadmin', function () {
    return redirect('http://localhost:8001');
});

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');
// Route::group(['middleware' => 'auth'], function (){
//     Route::get('profile', function(){
//         return "Hi";
//     });
// });

Route::prefix('todos')->as('todos.')->controller(TodoController::class)->group(function(){
    Route::get('index',[TodoController::class, 'index'])->name('index');
    Route::get('create',[TodoController::class, 'create'])->name('create');
    Route::post('store',[TodoController::class, 'store'])->name('store');
    Route::get('show/{id}',[TodoController::class, 'show'])->name('show');
    Route::get('{id}/edit', [TodoController::class, 'edit'])->name('edit');
    Route::put('update',[TodoController::class, 'update'])->name('update');
    Route::delete('destroy',[TodoController::class, 'destroy'])->name('destroy');
});
    