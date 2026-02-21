<?php

use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | contains the "web" middleware group. Now create something great! | */

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\SpotifyController;
Route::get('/login/spotify', [SpotifyController::class , 'login']);
Route::get('/callback', [SpotifyController::class , 'callback']);
Route::get('/dashboard', [SpotifyController::class , 'index']);