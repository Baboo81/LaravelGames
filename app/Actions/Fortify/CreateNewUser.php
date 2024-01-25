<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Services\EmailService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        /*Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();*/

        $email = $input['email'];

        //Génération d'un token pour l'activation du compte:
        //Création d'une clé unique hachée en md5 afin que chaque utilisateur possède un token unique
        $activation_token = md5(uniqid())  . $input['email'] . sha1($email);

        $activation_code = "";
        $length_code = 6;//Pour un code à 6 chiffres

        for($i = 0; $i < $length_code; $i++)
        {
            $activation_code .= mt_rand(0,9);//mt_rand, génère un nb aléatoire
        }

        $name = $input['firstname'] . ' ' . $input['lastname'];

        //Instanciation de la class ServiceEmail:
        $emailSend = new EmailService;
        $subject = "Acivate your account";
        $message = "Hi " . $name . "Please activate your account ! Copy and past your activation code !" . $activation_code . "Or click to the link bellow to activate your account, link : " . $activation_token;

        $emailSend->sendEmail($subject, $email, $name, false, $message);


        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($input['password']),
            'activation_code' => $activation_code, //la classe activation_code va recevoir la $activation_code
            'activation_token' => $activation_token,
        ]);
    }
}
