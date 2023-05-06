<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ApiAuthController extends BaseController
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login(Request $request)
    {
        // Validate user credentials
        $credentials = $request->only(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        // Create API token for authenticated user
        $token = $request->user()->createToken('API Token')->plainTextToken;

        // Return token to the user
        return response()->json(['token' => $token, 'user' => $request->user()]);
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
