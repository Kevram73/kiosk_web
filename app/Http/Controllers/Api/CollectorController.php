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

        $users = User::all();
        $collectors = [];
        foreach($users as $user){
            if($user->role() == "COLLECTOR"){
                $collectors[] = $user;
            }
        }
        // $users = $role->getUsersByRole();
        return response()->json([
            'status' => 'success',
            'users' => $collectors,
        ], 200);
    }

    public function login(Request $request){
        $credentials = $request->only(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $token = $request->user()->createToken('API Token')->plainTextToken;
        return response()->json(['token' => $token, 'user' => $request->user(), "role" => $request->user()->role()]);
    }

    public function register(Request $request){
        $myrole = Role::where("name", "COLLECTOR")->get()->first();

        $user = new User;
        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->sexe = $request->input('sexe');
        $user->email = $request->input('email');
        $user->boutique_id = 1;
        $user->contact = $request->input('contact');
        $user->password = Hash::make('password');
        $user->assignRole($myrole);
        $user->save();
        return response()->json([
            'status' => 'success',
            'collector' => $user,
        ], 200);
    }

    public function solde(Request $request){
        return response()->json(['solde' => $request->user()]);
    }
}
