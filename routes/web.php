<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReviewController;
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

Route::resource('user', UserController::class);
Route::resource('ad', AdController::class);

Route::get('/settings', [UserController::class, 'showSettings'])->name('settings');

Route::post('/language', [LangController::class, 'changeLang'])->name('changeLang');

Route::get('/ad/buy/{id}', [BuyController::class, 'buy'])->name('ad.buy');

Route::get('/favourite/{id}', [FavouriteController::class, 'favourite'])->name('ad.favourite');
Route::get('/unfavourite/{id}', [FavouriteController::class, 'unfavourite'])->name('ad.unfavourite');

Route::post('/ad/review/{id}', [ReviewController::class, 'storeAd'])->name('review.ad_create');
Route::post('/user/review/{id}', [ReviewController::class, 'storeUser'])->name('review.user_create');
Route::post('/review/update/{id}', [ReviewController::class, 'update'])->name('review.update');
Route::get('/review/destroy/{id}', [ReviewController::class, 'destroy'])->name('review.delete');

Route::get('/', [AdController::class, 'index'])->name('ads');
