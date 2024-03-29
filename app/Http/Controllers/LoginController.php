<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\EmailService;


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
        $user = User::where('activation_token', $token)->first();

        if(!$user)
        {
            return redirect()->route('login')->with('danger', 'This token doesn\'t match any user !');
        }

        if ($this->request->isMethod('post'))
        {
            //Récuperation du code saisi par le user afin de le comparer avec celui de la DB:
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

        $emailSend = new EmailService;
        $subject = "Acivate your account";


        $emailSend->sendEmail($subject, $email, $name, true, $activation_code, $activation_token);

        return redirect()->route('app_activation_code', ['token' => $token])
                         ->with('success', 'You have just resend the new activation code');
    }

    public function activationAccountLink ($token)
    {
        //Récupération du token:
        $user = User::where('activation_token', $token)->first();

        if(!$user)
        {
            return redirect()->route('login')->with('danger', 'This token doesn\'t match any user !');
        }

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

    public function activationAccountChangeEmail($token)
    {
        $user = User::where('activation_token', $token)->first();

        if($this->request->isMethod('post'))
        {
            $new_email = $this->request->input('new-email');
            $user_exist = User::where('email', $new_email)->first();


            if($user_exist)
            {
                return back()->with([
                    'danger' => 'This address email is already used ! please enter another email !',
                    'new_email' => $new_email,
                ]);
            } else {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'email' => $new_email
                    ]);

                    $activation_code = $user->activation_code;
                    $activation_token = $user->activation_token;
                    $name = $user->name;

                    $emailSend = new EmailService;
                    $subject = "Acivate your account";


                    $emailSend->sendEmail($subject, $new_email, $name, true, $activation_code, $activation_token);

                    return redirect()->route('app_activation_code',['token' =>$token])
                                     ->with('success', 'You have just resend the new activation code !');

            }

        } else {
            return view('auth.activation_account_change_email', ['token' => $token]);
        }

    }
}
