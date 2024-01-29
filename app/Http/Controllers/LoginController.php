<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        if($is_verified != 1)//Si le compte n'est pas encore vérifié:
        {
            Auth::logout();//Déconnecte l'utilisateur

            return redirect()->route('app_activation_code', ['token' => $activation_token])
                            ->with('warning', 'Your account is not activated yet, please check your mailbox and actiavte your account or resend the confirmation message !');
        } else {
            return redirect()->route('app_dashboard');
        }
    }

    public function activationCode ($token)
    {
        if ($this->request->isMethod('post'))
        {
            //Récuperation du code saisi par le user afin de le comparer avec celui de la DB:
            $user = User::where('activation_token', $token)->first();
            $code = $user->activation_code;
            $activationCode = $this->request->input('activation_code');


           if ($activationCode != $code)
           {
                return back()->with('danger', 'This activation code is invalid !');
           } else {
                DB::table('users')
                 ->where('id', $user->id)
                 ->update([
                    'is_verified' => 1,
                    'activation_code' => '',
                    'activation_token' => '',
                    'email_verified_at' => new \DateTimeImmutable,
                    'updated_at' => new \DateTimeImmutable,
                 ]);

                 return redirect()->route('login')->with('succes', 'Your email address has been verifed !');
           }
        }

        return view('auth.activation_code', [
            'token' => $token,
        ]);
    }

    public function resendActivationCode ($token)
    {
        $user = User::where('activation_token', $token)->first();
        $email = $user->email;
        $name = $user->name;
        $activation_token = $user->activation_token;
        $activation_code = $user->activation_code;
    }
}
