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

Route::get('/snake', [HomeController::class, 'snakeGame'])
    ->name('app_snake');

Route::get('/flyingDuky', [HomeController::class, 'dukyGame'])
    ->name('app_duky');

Route::get('/about', [HomeController::class, 'about'])
    ->name('app_about');

//match permet de combiner les méthodes get et post afin de recevoir et d'envoyer des données:
//L'utilisateur sera redirigé vers la page dashboard une fois l'authentification réussie:
Route::match(['get', 'post'], '/dashboard', [HomeController::class, 'dashboard'])
    ->middleware('auth')//la page dashboard sera accessible pour les personnes authentifiées
    ->name('app_dashboard');

//Grâce à fortify ns pouvons mettre en commentaire ces 2 routes, cette lib va gérer les logins et les authentifiactions
/*Route::match(['get', 'post'], '/login',[LoginController::class, 'login'])
    ->name('app_login');

Route::match(['get', 'post'], '/register', [LoginController::class, 'register'])
    ->name('app_register');*/

Route::get('/logout', [LoginController::class, 'logout'])
    ->name('app_logout');

//Nous utilisons la méthode POST car nous envoyons des données uniquement:
Route::post('/exist_email', [LoginController::class, 'existEmail'])
    ->name('app_exist_email');

Route::match(['get', 'post'], '/activation_code/{token}', [LoginController::class, 'activationCode'])
    ->name('app_activation_code');

Route::get('/user_checker', [LoginController::class, 'userChecker'])
    ->name('app_userchecker');
