<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\LoginController;
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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/register', [UserController::class, 'store']);

Route::get('/profile/{id}', [UserController::class, 'showProfile'])->name('profile');
Route::get('/settings', [UserController::class, 'showSettings'])->name('settings');

Route::post('/language', [LangController::class, 'changeLang'])->name('changeLang');

Route::get('/ad/create', [AdController::class, 'create'])->name('ad.create');
Route::post('/ad/create', [AdController::class, 'store']);
Route::get('/ad/{id}', [AdController::class, 'show'])->name('ad');

Route::get('/favourite/{id}', [FavouriteController::class, 'favourite'])->name('ad.favourite');
Route::get('/unfavourite/{id}', [FavouriteController::class, 'unfavourite'])->name('ad.unfavourite');

Route::get('/', [AdController::class, 'index'])->name('ads');
