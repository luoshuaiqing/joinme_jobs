<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class loginController extends Controller
{
    public function login() {

    }

    public function test() {


    }

    // the verification code will always be joinmenow
    public function signup(Request $request) {
        $request->validate([
            'email' => [
                'required',
                'email:rfc'
            ],
            'password' => [
                'required'
            ],
            'verification-code' => [
                'required'
            ]
        ]);

        // email can not exist in table for student nor tutor
        $request->validate([
            'email' => [new NotExistEmail],
        ]);

        $user = new User();
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        Auth::login($user);

        return redirect()
                ->route('profile');

    }
}
