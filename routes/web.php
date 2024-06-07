<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingsController;
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

Route::resources([  'user' => UserController::class, 
                    'ad' => AdController::class]);

Route::get('/ad/qr/{id}', [AdController::class, 'getQr'])->name('ad.qr');

Route::get('/settings/active-ads', [SettingsController::class, 'activeAds'])->name('settings.active_ads');
Route::get('/settings/active-ads', [SettingsController::class, 'activeAds'])->name('settings.active_ads');
Route::get('/settings/bought-ads', [SettingsController::class, 'boughtAds'])->name('settings.bought_ads');
Route::get('/settings/sold-ads', [SettingsController::class, 'soldAds'])->name('settings.sold_ads');
Route::get('/settings/favourites', [SettingsController::class, 'favourites'])->name('settings.favourites');
Route::get('/settings/profile', [SettingsController::class, 'editProfile'])->name('profile.edit');
Route::post('/settings/profile', [SettingsController::class, 'updateProfile'])->name('profile.update');

Route::post('/language', [LangController::class, 'changeLang'])->name('change_lang');

Route::get('/ad/buy/{id}', [BuyController::class, 'buy'])->name('ad.buy');
Route::post('/ad/bid/{id}', [BidController::class, 'bid'])->name('ad.bid');
Route::get('/ad/finish/{id}', [BidController::class, 'finishAuction'])->name('ad.finish');
Route::post('/ad/rent/{id}', [LeaseController::class, 'lease'])->name('ad.rent');

Route::get('/favourite/{id}', [FavouriteController::class, 'favourite'])->name('ad.favourite');
Route::get('/unfavourite/{id}', [FavouriteController::class, 'unfavourite'])->name('ad.unfavourite');

Route::post('/ad/review/{id}', [ReviewController::class, 'storeAd'])->name('review.ad_create');
Route::post('/user/review/{id}', [ReviewController::class, 'storeUser'])->name('review.user_create');
Route::post('/review/update/{id}', [ReviewController::class, 'update'])->name('review.update');
Route::get('/review/destroy/{id}', [ReviewController::class, 'destroy'])->name('review.delete');

Route::get('/', [AdController::class, 'index'])->name('ads');
