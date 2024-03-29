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

Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'home')
        ->name('app_home');
    Route::get('/snake', 'snakeGame')
        ->name('app_snake');
    Route::get('/flyingDuky', 'dukyGame')
        ->name('app_duky');
    Route::get('/about', 'about')
        ->name('app_about');
    //match permet de combiner les méthodes get et post afin de recevoir et d'envoyer des données:
    //L'utilisateur sera redirigé vers la page dashboard une fois l'authentification réussie:
    Route::match(['get', 'post'], '/dashboard', 'dashboard')
        ->middleware('auth')//la page dashboard sera accessible pour les personnes authentifiées
        ->name('app_dashboard');
});

Route::controller(LoginController::class)->group(function(){
    //Grâce à fortify ns pouvons mettre en commentaire ces 2 routes, cette lib va gérer les logins et les authentifiactions
    /*Route::match(['get', 'post'], '/login',[LoginController::class, 'login'])
    ->name('app_login');

    Route::match(['get', 'post'], '/register', [LoginController::class, 'register'])
    ->name('app_register');*/
    Route::get('/logout', 'logout')
        ->name('app_logout');
    //Nous utilisons la méthode POST car nous envoyons des données uniquement:
    Route::post('/exist_email', 'existEmail')
        ->name('app_exist_email');
    Route::match(['get', 'post'], '/activation_code/{token}', 'activationCode')
        ->name('app_activation_code');
    Route::get('/user_checker', 'userChecker')
        ->name('app_userchecker');
    //Création de la route pour le renvoi d'un mail si le premier n'est pas arrivé:
    Route::get('/resend_activation_code/{token}', 'resendActivationCode')
        ->name('app_resend_activation_code');
    //Création de la route de confirmation d'email:
    Route::get('/activation_account_link/{token}', 'activationAccountLink')
        ->name('app_activation_account_link');
    //Route qui gère le changement d'adresse mail:
    Route::match(['get', 'post'], '/activation_account_change_email/{token}', [LoginController::class, 'activationAccountChangeEmail'])
        ->name('app_activation_account_change_email');
});























