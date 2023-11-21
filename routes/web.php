<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Auth;

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
