<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ApiAuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|string'
        ];
        $messages = array(
            'email.required' => "Email est obligatoire",
            'password.required' => "Mot de passe est obligatoire"
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        // Check the validation becomes fails or not
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        } else {

            $credentials = $request->only('email', 'password');

            $jwt_token = Auth::attempt($credentials);

            // Get the user data.
            $user = User::where('email', $request->email)->first();

            // Attempt to verify the input and create a token for the users
            if (!$jwt_token = JWTAuth::attempt($credentials)) {

                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized',
                ], 401);
            } else {

                // All good so return the token
                return response()->json([
                    'success' => true,
                    'token' => $jwt_token,
                    'user'  => $user,
                    'message' => 'Utilisateur connecté avec succès.',
                ]);
            }
        }
    }

    public function updatePassword(Request $request, $user_id)
    {
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ];
        $messages = array(
            'old_password.required' => 'Mot de passe actuel est obligatoire.',
            'new_password.required' => 'Nouveau mot de passe est obligatoire.',
            'confirm_password.required' => 'Confirmation mot de passe est obligatoire.',
            'confirm_password.same' => 'Confirmation mot de passe et le nouveau mot de passe doivent être identiques',
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        // Check the validation becomes fails or not
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        } else {

            $user = User::findOrFail($user_id); //Get user specified by id

            if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {

                return $this->sendError('Votre mot de passe actuel est incorrect! Veuillez vérifier svp!');
            } else if ((Hash::check(request('new_password'), Auth::user()->password)) == true) {

                return $this->sendError("Veuillez entrer un mot de passe qui n\'est pas similaire à l\'actuel.");
            } else {

                $user->password = $request->input('new_password');
                $user->save();

                return $this->sendResponse($user, 'Mot de passe mis à jour avec succès.');
            }
        }
    }
}
