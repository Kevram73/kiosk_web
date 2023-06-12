<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CollectorController extends BaseController
{

    public function get_list_collectors(Request $request){

        $role = Role::where('name', 'COLLECTOR')->first();
        $users = $role->getUsersByRole();
        return response()->json([
            'status' => 'success',
            'users' => $users,
        ], 200);
    }

    public function login(Request $request){
        $credentials = $request->only(['email', 'password']);
        if (!Auth::attempt($credentials) || $request->user()->role() != "COLLECTOR") {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $token = $request->user()->createToken('API Token')->plainTextToken;
        return response()->json(['token' => $token, 'user' => $request->user(), "role" => $request->user()->role()]);
    }

    public function register(Request $request){
        $myrole = Role::findByName("COLLECTOR");

        $user = new User;
        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->sexe = $request->input('sexe');
        $user->email = $request->input('email');
        $user->boutique_id = $request->input('boutique');
        $user->contact = $request->input('contact');
        $user->password = Hash::make('password');
        $user->assignRole($myrole);
        $user->save();
        return response()->json([
            'status' => 'success',
            'collector' => $user,
        ], 200);
    }
}
