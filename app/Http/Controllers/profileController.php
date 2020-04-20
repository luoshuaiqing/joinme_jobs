<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Auth;

class profileController extends Controller
{
    public function show_profile() {

        $user = Auth::user();
        $firstName = $user->first_name;
        $lastName = $user->last_name;


        $photoUrl = asset('user_photos/9FRZHWLdBGd3gcOtMOPVDMxW0eqYOzp0HpFngANf.png');

        return view('profile', [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'photoUrl' => $photoUrl
        ]);
    }

    // todo: post method for edit profile, make sure keep old input if anything goes wrong, and check for image upload
    public function edit_profile(Request $request) {

        $path = $request->file('imageUpload')->store('');

        return $path;
    }


}


