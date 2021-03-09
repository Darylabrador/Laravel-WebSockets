<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Handle user connection.
     *
     * @return \Illuminate\Http\Response
     */
    public function connection(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email'    => 'required',
                'password' => 'required',
            ],
            [
                'required' => 'Le champ :attribute est requis',
            ]
        );

        $errors = $validator->errors();

        if (count($errors) != 0) {
            return response()->json([
                'success' => false,
                'message' => $errors->first()
            ]);
        }

        $email      = $validator->validated()['email'];
        $password   = $validator->validated()['password'];
        $userExist  = User::where(["email" => $email])->first();

        if (!$userExist) {
            return response()->json([
                'success' => false,
                'message' => "Adresse email ou mot de passe incorrecte"
            ]);
        }

        if (Hash::check($password, $userExist->password)) {
            $token = $userExist->createToken('AuthToken')->accessToken;
            return response()->json([
                "success" => true,
                "message" => "Vous êtes connecté !",
                "token"   => $token
            ]);
        } 

        return response()->json([
            'success' => false,
            'message' => "Adresse email ou mot de passe incorrecte",
        ]);
    }


    /**
     * Handle create user's account.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email'           => 'required|unique:users',
                'name'            => 'required',
                'password'        => 'required',
                'passwordConfirm' => 'required',
            ],
            [
                'required' => 'Le champ :attribute est requis',
                'unique'   => 'Adresse email existe déjà'
            ]
        );

        $errors = $validator->errors();

        if (count($errors) != 0) {
            return response()->json([
                'success' => false,
                'message' => $errors->first()
            ]);
        }

        $name              = $validator->validated()['name'];
        $email             = $validator->validated()['email'];
        $password          = $validator->validated()['password'];
        $passwordConfirm   = $validator->validated()['passwordConfirm'];

        if ($password != $passwordConfirm) {
            return response()->json([
                "success" => false,
                "message" => "Les mots de passe ne sont pas identique"
            ]);
        }

        $user = new User();
        $user->name          = $name;
        $user->email         = $email;
        $user->password      = Hash::make($password);
        $user->save();

        return response()->json([
            "success" => true,
            "message" => "Inscription réussie"
        ]);
    }


    /**
     * Handle disconnect request.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json(['success' => true]);
    }


    /**
     * Check token validity
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyToken()
    {
        $loggedUser   = Auth::user();
        return response()->json(['data' => $loggedUser]);
    }
}
