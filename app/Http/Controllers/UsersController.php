<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Cookie\Factory;
use Illuminate\Support\Facades\Cookie;

class UsersController extends Controller
{

    //
    public function login(Request $request,Factory $cookie){
        $username = $request->input('username');
        $password = $request->input('password');

        if (empty($username))
            return response()->json(['errors' => 'Username in empty']);

        if (empty($password))
            return response()->json(['errors' => 'Password in empty']);

        $user = User::where('username', $username)->first();

        if ($user) {
            if (!Hash::check($password, $user->password))
                return response()->json(['errors' => 'Wrong password']);

            $data = [
                'auth' => true,
                'id' => $user->id,
                'username' => $user->username
            ];

            $cookie->queue($cookie->make('user', serialize($data), 10080));

            return response('ok');
        } else {
            $user = User::create([
                'username' => $username,
                'password' => Hash::make($password),
            ]);
            $data = [
                'auth' => true,
                'id' => $user->id,
                'username' => $user->username
            ];

            $cookie->queue($cookie->make('user', serialize($data), 10080));

            return response('ok');
        }
    }

    public function logout(){
        if(!empty($_COOKIE['user']))
          $cookie = Cookie::forget('user');

        return redirect()->back()->withCookie($cookie);
    }
}
