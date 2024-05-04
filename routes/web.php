<?php

use App\Http\Controllers\MessagesController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;



Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');

Route::resource('messages',MessagesController::class);

Route::resource('projects',ProjectController::class);
