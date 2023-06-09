<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('/users', 'users.showAll')->name('users.all');

Route::get('/chat', 'App\Http\Controllers\ChatController@showChat')->name('chat.show');
Route::get('/slot', 'App\Http\Controllers\SlotController@showSlot')->name('slot.show');


Route::post('/chat/message', 'App\Http\Controllers\ChatController@messageReceived')->name('chat.message');

Route::post('/chat/greet/{user}', 'App\Http\Controllers\ChatController@greetReceived')->name('chat.greet');

Route::post('/slot/bets', 'App\Http\Controllers\SlotController@saveBets')->name('slot.bets');
