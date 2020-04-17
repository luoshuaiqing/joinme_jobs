<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Hash;
use App\Rules\NotExistEmail;
use Illuminate\Validation\Rule;
use App\User;

class authController extends Controller
{
    public function login(Request $request) {

        $request->validate([
            'email' => [
                'required',
                'email:rfc',
                'exists:users'
            ],
            'password' => [
                'required'
            ]
        ]);


        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('profile');
        }
        else {
            return redirect()->route('index')->with(
                'loginError',
                "Please check your email and password."
            )->withInput();
        }

    }

    public function logout() {
        Auth::logout();
        return redirect()->route('index');
    }

    // the verification code will always be joinmenow
    public function signup(Request $request) {
        $verificationCode = 'joinmenow';
        $request->validate([
            'email' => [
                'required',
                'email:rfc'
            ],
            'password' => [
                'required',
                'min:6',
                'alpha_num'
            ],
            'verificationCode' => [
                'required',
                Rule::in([$verificationCode])
            ],
            'asEmployee' => [
                'required'
            ]
        ]);

        // // email can not exist in table for student nor tutor
        $request->validate([
            'email' => [new NotExistEmail]
        ]);

        // if sign up is success
        $user = new User();
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->is_employee = $request->input('asEmployee');
        $user->save();

        Auth::login($user);
        $request->session()->flash('signupSuccess', 'Sign Up Success! Please complete your profile information.');

        return response()->json(
            [
                'success' => true
            ]
        );


    }

}
