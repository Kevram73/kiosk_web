<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



class Auth extends Controller
{
    /**
     * Return token nd user info given username and password.
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
      /**
      **
          $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $email =$data['username'];
        $password =$data['password'];

        $user = DB::table('users')->where('password',$password)->where('email',$email) ;


        return response()->json($user->toArray()) ;
      **/

        return "hello";

    }

}

