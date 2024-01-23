<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function existEmail()
    {
        $email = null;

        $user = User::where('email', $email)
                ->first();


        $response = "";
        ($user) ? $response = "exist" : $response = "not_exist"
    }
}
