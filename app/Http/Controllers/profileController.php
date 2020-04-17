<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class profileController extends Controller
{
    public function show_profile() {
        $user = Auth::user();
        $firstName = $user->first_name;
        $lastName = $user->last_name;


        return view('profile', [
            'firstName' => $firstName,
            'lastName' => $lastName
        ]);
    }

    // todo: post method for edit profile, make sure keep old input if anything goes wrong, and check for image upload
}
