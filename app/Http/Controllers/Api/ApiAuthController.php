<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ApiAuthController extends Controller
{
    /**
     * Return token nd user info given username and password.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function get_user(Request $request)
    {

          $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);


        if (Auth::attempt($data)){
            // return the user
            $user = User::where('email',$data['email'])->get() ;

            return response()->json($user) ;
        }

        return response("",404) ;

    }

    public function get_role_list(Request $request)
    {
        $response = DB::table('roles')
            ->join('model_has_roles','model_has_roles.role_id','=','roles.id')
            ->join('users','users.id','=','model_has_roles.model_id')
            ->select(
                'roles.name as role_name',
                  'roles.id as role_id',
                'model_has_roles.model_id as user_id',
                'users.nom as users_last_name',
                'users.prenom as user_first_name'
            )
            ->get() ;

        //$response = DB::table('roles')
        //    ->join('model_has_role',function ($join){
        //        $join->on('model_has_roles.role_id','=','')
        //    })
        return response()->json($response);
    }

}

