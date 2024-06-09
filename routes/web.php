<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\UserLoggedIn;
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

Route::get('/', [AdController::class, 'index'])->name('ads');
Route::post('/language', [LangController::class, 'changeLang'])->name('change_lang');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/ad/qr/{id}', [AdController::class, 'getQr'])->name('ad.qr');
Route::resources(['user' => UserController::class, 'ad' => AdController::class, 'contract' => ContractController::class]);

Route::middleware([UserLoggedIn::class])->group(function () {
    // Reviews
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/ad/review/{id}', [ReviewController::class, 'storeAd'])->name('review.ad_create');
    Route::post('/user/review/{id}', [ReviewController::class, 'storeUser'])->name('review.user_create');
    Route::post('/review/update/{id}', [ReviewController::class, 'update'])->name('review.update');
    Route::get('/review/destroy/{id}', [ReviewController::class, 'destroy'])->name('review.delete');

    // Ad buy actions
    Route::get('/ad/buy/{id}', [BuyController::class, 'buy'])->name('ad.buy');
    Route::post('/ad/bid/{id}', [BidController::class, 'bid'])->name('ad.bid');
    Route::get('/ad/finish/{id}', [BidController::class, 'finishAuction'])->name('ad.finish');
    Route::post('/ad/rent/{id}', [LeaseController::class, 'lease'])->name('ad.rent');

    // Favourites
    Route::get('/favourite/{id}', [FavouriteController::class, 'favourite'])->name('ad.favourite');
    Route::get('/unfavourite/{id}', [FavouriteController::class, 'unfavourite'])->name('ad.unfavourite');

    // Settings
    Route::get('/settings/active-ads', [SettingsController::class, 'activeAds'])->name('settings.active_ads');
    Route::get('/settings/active-ads', [SettingsController::class, 'activeAds'])->name('settings.active_ads');
    Route::get('/settings/bought-ads', [SettingsController::class, 'boughtAds'])->name('settings.bought_ads');
    Route::get('/settings/sold-ads', [SettingsController::class, 'soldAds'])->name('settings.sold_ads');
    Route::get('/settings/favourites', [SettingsController::class, 'favourites'])->name('settings.favourites');
    Route::get('/settings/calendar', [CalendarController::class, 'calendar'])->name('settings.calendar');
    Route::get('/settings/profile', [SettingsController::class, 'editProfile'])->name('profile.edit');
    Route::post('/settings/profile', [SettingsController::class, 'updateProfile'])->name('profile.update');
    Route::get('/settings/business', [BusinessController::class, 'edit'])->name('business.edit');
    Route::post('/settings/business', [BusinessController::class, 'update'])->name('business.update');
    Route::get('/settings/business/api', [BusinessController::class, 'apiKeys'])->name('business.api_keys');
    Route::post('/settings/business/api/generate', [BusinessController::class, 'generateApiKey'])->name('business.generate_key');
    Route::get('/settings/business/api/destroy/{key}', [BusinessController::class, 'destroyApiKey'])->name('business.destroy_key');
});

Route::get('/{url}', [BusinessController::class, 'show'])->name('business.details');
