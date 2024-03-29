<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Counter;

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
    return view('home');
});

// View Routes
Route::view('/sending', 'sending');
Route::view('/rubik', 'rubik');



// Email related routes
Route::post('/send', [MailController::class, 'store']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Counter
Route::get('/todo', [App\Http\Controllers\HomeController::class, 'todo'])->name('todo');

// Posts
Route::get('/post', [App\Http\Controllers\HomeController::class, 'post'])->name('post');
