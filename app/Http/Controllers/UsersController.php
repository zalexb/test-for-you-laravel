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

        $validatedData = $request->validate([
            'username' => 'required|max:15',
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
