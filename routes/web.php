<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'home'])->name('app_home');

Route::get('/about', [HomeController::class, 'about'])->name('app_about');

Route::match(['get', 'post'], '/dashboard', [HomeController::class, 'dashboard'])->name('app_dashboard');
