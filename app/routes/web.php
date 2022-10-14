<?php

use App\Http\Controllers\GuildController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::get('/', [GuildController::class, 'index']);

Auth::routes();
Route::get('/guild/create', [GuildController::class, 'create']);
Route::get('/guild/{id}', [GuildController::class, 'get']);

Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'get'])->name('home');


