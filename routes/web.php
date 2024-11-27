<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Counter;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\DashboardController;

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
    return view('/');
});

// View Routes
Route::view('/sending', 'sending');
Route::view('/rubik', 'rubik');
Route::view('/notes', 'notes');
Route::view('/dashboard', 'dashboard');

// Email related routes
Route::post('/send', [MailController::class, 'store']);

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');

// To Do
Route::get('/todo', [App\Http\Controllers\HomeController::class, 'todo'])->name('todo');

// Posts
Route::get('/post', [App\Http\Controllers\HomeController::class, 'post'])->name('post');

// Notes
Route::get('/notes', [NoteController::class, 'index'])->name('notes');
Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
Route::put('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');
Route::post('/notes/{note}/toggle-favorite', [NoteController::class, 'toggleFavorite'])->name('notes.toggle-favorite');
Route::get('/notes/category/{category}', [NoteController::class, 'getByCategory'])->name('notes.by-category');
Route::get('/notes/favorites', [NoteController::class, 'getFavorites'])->name('notes.favorites');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/refresh-weather', [DashboardController::class, 'refreshWeather'])->name('dashboard.refresh-weather');
Route::get('/dashboard/refresh-news', [DashboardController::class, 'refreshNews'])->name('dashboard.refresh-news');
