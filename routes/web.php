<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
|--------------------------------------------------------------------------
| Generals routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/connexion', function () {
    return view('login');
})->name('login');

Route::get('/inscription', function(){
    return view('register');
})->name('register');


/*
|--------------------------------------------------------------------------
| Disable websockets dashboard route
|--------------------------------------------------------------------------
*/

Route::get('/laravel-websockets', function () {
    return redirect()->route('login');
});