<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Default to connect / create / disconnect user
 */
Route::post('/connexion', [AuthController::class, "connection"])->name('api.connexion');
Route::post('/inscription', [AuthController::class, "register"])->name('api.inscription');
Route::get('/logout', [AuthController::class, "logout"])->middleware('auth:api')->name('api.logout');


/**
 * Store messages and retrieve
 */
Route::middleware('auth:api')->group(function() {
    Route::get('/messages', [MessageController::class, 'store'])->name('api.message.store');
    Route::post('/messages', [MessageController::class, 'retrieve'])->name('api.message.retrieve');
});
