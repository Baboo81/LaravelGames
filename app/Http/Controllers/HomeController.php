<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('home.home');
    }

    public function about()
    {
        return view('home.about');
    }

    public function dashboard()
    {
        return view('home.dashboard');
    }

    public function snakeGame()
    {
        return view('home.snake');
    }

    public function dukyGame()
    {
        return view('home.flyingDuky');
    }
}
