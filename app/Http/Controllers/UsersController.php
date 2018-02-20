<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    //
    public function login(Request $request)
    {
        /*  $username = $request->input('username');
          $password = $request->input('password');

          if (empty($username))
              return response()->json(['errors' => 'Username in empty']);

          if (empty($password))
              return response()->json(['errors' => 'Password in empty']);*/
        $validatedData = $request->validate([
            'username' => 'required|max:50',
            'password' => 'required',
        ]);

        $user = User::where('username', $validatedData['username'])->first();

        if ($user) {
            if (!Hash::check($validatedData['password'], $user->password))
                return response()->json(['errors' => 'Wrong password']);

            $data = [
                'auth' => true,
                'id' => $user->id,
                'username' => $user->username
            ];

            session(['user' => $data]);

            return response('{success:true}');
        } else {
            $user = User::create([
                'username' => $validatedData['username'],
                'password' => Hash::make($validatedData['password']),
            ]);
            $data = [
                'auth' => true,
                'id' => $user->id,
                'username' => $user->username
            ];

            session(['user' => $data]);

            return response('{success:true}');
        }
    }

    public function logout(Request $request)
    {
        if($request->session()->has('user'))
            $request->session()->forget('user');

        return redirect()->back();
    }
}
