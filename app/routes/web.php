<?php

use App\Http\Controllers\ChannelController;
use App\Http\Controllers\GuildController;
use App\Http\Controllers\HomeController;
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
Route::get('/', [HomeController::class, 'index']);

Route::post('/guild/create', [GuildController::class, 'create']);
Route::post('/guild/join', [GuildController::class, 'join']);
Route::post('/guild/{id}/edit', [GuildController::class, 'edit']);
Route::get('/guild/{id}', [GuildController::class, 'get']);
Route::post('/guild/{guildId}/delete', [GuildController::class, 'deleteGuild']);

Route::post('/guild/{guildId}/create', [ChannelController::class, 'create']);
Route::post('/guild/{guildId}/message/{messageId}', [ChannelController::class, 'deleteMessage']);
Route::get('/guild/{guildId}/{channelId}', [ChannelController::class, 'get']);
Route::post('/guild/{guildId}/{channelId}', [ChannelController::class, 'createMessage']);
Route::post('/guild/{guildId}/{channelId}/delete', [ChannelController::class, 'deleteChannel']);

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'get'])->name('home');


Route::get('api/guild/{guildId}/{channelId}/{lastMessageId}', [ChannelController::class, 'getMessages']);

