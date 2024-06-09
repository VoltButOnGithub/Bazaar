<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/ads', [AdApiController::class, 'ads'])->middleware('auth:sanctum');
Route::get('/ad/{id}', [AdApiController::class, 'ad'])->middleware('auth:sanctum');
