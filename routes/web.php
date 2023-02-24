<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
})->name('welcome');

Route::post('/register', [UserController::class, 'register'])->name('register');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/secret_page', [PageController::class, 'index'])->name('secret_page');
    Route::post('/secret_page', [PageController::class, 'createLink'])->name('create_link');
    Route::post('/secret_page/delete', [PageController::class, 'deleteLink'])->name('delete_link');
    Route::post('/secret_page/test_luck', [PageController::class, 'testLuck'])->name('get_luck');
    Route::post('/secret_page/show_history', [PageController::class, 'showHistory'])->name('show_history');
});

