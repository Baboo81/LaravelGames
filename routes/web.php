<?php

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

//Route::get('articles', [\App\Http\Controllers\PostController::class, 'index']);//Route écoute la home page

//Route::get('snake', [\App\Http\Controllers\PostController::class, 'snakeGame']);

//Route::get('/', function() {
//    return view('welcome');
//});

Route::get('/', function() {
    return view('home.home');
})->name('app_home');

Route::get('/about', function() {
    return view('home.about');
})->name('app_about');
