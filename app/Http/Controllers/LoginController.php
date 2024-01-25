<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $request;

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function existEmail()
    {
        $email = $this->request->input('');

        $user = User::where('email', $email)
                ->first();


        $response = "";

        ($user) ? $response = "exist" : $response = "not_exist";

        return response()->json([
            'code' => 200,
            'response' => $response
        ]);
    }

    public function userChecker ()
    {
        /**
         * Vérifier si l'utilisateur a déjà acitvé son compte ou pas
         * avant d'être authentifié
         */
        $activation_token = Auth::user()->activation_token;
        $is_verified = Auth::user()->is_verified;

        if($is_verified != 1)
        {
            return redirect()->route('app_activation_code', ['token' => $activation_token])
                            ->with('warning', 'Your account is not activate yet, please check your mailbox and actiavte your account or resend the confirmation message !');
        } else {
            return redirect()->route('app_dashboard');
        }
    }

    public function activationCode ($token)
    {
        return view('auth.activation_code', [
            'token' => $token,
        ]);
    }
}
