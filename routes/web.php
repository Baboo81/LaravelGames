<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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

Route::get('/', [HomeController::class, 'home'])
    ->name('app_home');

Route::get('/about', [HomeController::class, 'about'])
    ->name('app_about');

//match permet de combiner les méthodes get et post afin de recevoir et d'envoyer des données:
//L'utilisateur sera redirigé vers la page dashboard une fois l'authentification réussie:
Route::match(['get', 'post'], '/dashboard', [HomeController::class, 'dashboard'])
    ->name('app_dashboard');

//Grâce à fortify ns pouvons mettre en commentaire ces 2 routes, cette lib va gérer les logins et les authentifiactions
/*Route::match(['get', 'post'], '/login',[LoginController::class, 'login'])
    ->name('app_login');

Route::match(['get', 'post'], '/register', [LoginController::class, 'register'])
    ->name('app_register');*/

Route::get('/logout', [LoginController::class, 'logout'])
    ->name('app_logout');
