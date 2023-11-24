<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\User;
use App\CollectorShop;
use App\Collecter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;



class ApiAuthController extends BaseController
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    // Login function
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (!Auth::attempt($credentials) && $request->user()->hasRole("CAISSIER")) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $token = $request->user()->createToken('API Token')->plainTextToken;
        return response()->json(['token' => $token, 'user' => $request->user(), "role" => $request->user()->role()]);
    }


    // Logout function
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json(['message' => 'Logout successful']);
    }


    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'The current password is incorrect.'], 422);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Password changed successfully.']);
    }

    public function login_collector(Request $request){
        $credentials = $request->only(['email', 'password']);
        if (!Auth::attempt($credentials) && $request->user()->hasRole("COLLECTOR")) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $token = $request->user()->createToken('API Token')->plainTextToken;
        return response()->json(['token' => $token, 'user' => $request->user(), "role" => $request->user()->role()]);
    }

    public function register_collector(Request $request){
        $user = new User();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->sexe = $request->sexe;
        $user->email = $request->email;
        $user->contact = $request->contact;
        $user->password = "$2y$10$3Zhxu5tToajvOuTvwV8Y5.7vM.jWu2xw2FxHUNHcf5WyJzlwX83ae";
        $user->boutique_id = 1;
        $user->solde = 0;
        $user->assignRole('COLLECTOR');
        $user->save();

        return response()->json(['new_user' => $user]);
    }

    public function login_admin(Request $request){
        $credentials = $request->only(['email', 'password']);
        if (!Auth::attempt($credentials) && $request->user()->hasRole("ADMINISTRATEUR")) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $token = $request->user()->createToken('API Token')->plainTextToken;
        return response()->json(['token' => $token, 'user' => $request->user(), "role" => $request->user()->role()]);
    }

    public function register_admin(Request $request){
        $user = new User();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->sexe = $request->sexe;
        $user->email = $request->email;
        $user->contact = $request->contact;
        $user->password = "$2y$10$3Zhxu5tToajvOuTvwV8Y5.7vM.jWu2xw2FxHUNHcf5WyJzlwX83ae";
        $user->boutique_id = 1;
        $user->solde = 0;
        $user->assignRole('ADMINISTRATEUR');
        $user->save();

        return response()->json(['new_user' => $user]);


    }
}
