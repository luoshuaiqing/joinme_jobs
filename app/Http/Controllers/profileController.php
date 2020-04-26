<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Auth;
use Illuminate\Validation\Rule;



class profileController extends Controller
{
    public function show_profile() {

        $user = Auth::user();

        if($user->is_employee) {
            return view('profile.profile_employee', [
                'user' => $user
            ]);
        }
        else {
            return view('profile.profile_employer', [
                'user' => $user
            ]);
        }


    }

    // todo: post method for edit profile, make sure keep old input if anything goes wrong, and check for image upload
    public function edit_profile(Request $request) {
        $user = Auth::user();
        if($user->is_employee) {
            $request->validate([
                'firstName' => [
                    'required',
                    'alpha'
                ],
                'lastName' => [
                    'required',
                    'alpha'
                ],
                'gender' => [
                    'alpha',
                    Rule::in(['Male', 'Female', 'male', 'female'])
                ],
                'interestedCareer' => [
                    'alpha'
                ],
                'imageUpload' => [
                    'file',
                    'mimes:jpeg,bmp,png'
                ]
            ]);


            $user->first_name = $request->input('firstName');
            $user->last_name = $request->input('lastName');
            $user->gender = $request->input('gender');
            $user->interested_career = $request->input('interestedCareer');

            $this->saveProfilePic($request, $user);
            $user->save();
        }
        else {
            $request->validate([
                'firstName' => ['
                    required',
                    'alpha'
                ],
                'lastName' => [
                    'required',
                    'alpha'
                ],
                'gender' => [
                    'alpha',
                    Rule::in(['Male', 'Female', 'male', 'female'])
                ],
                'companyName' => [
                    'required'
                ],
                'imageUpload' => [
                    'file',
                    'mimes:jpeg,bmp,png'
                ]
            ]);


            $user->first_name = $request->input('firstName');
            $user->last_name = $request->input('lastName');
            $user->gender = $request->input('gender');
            $user->company_name = $request->input('companyName');

            $this->saveProfilePic($request, $user);
            $user->save();
        }


        return redirect()->route('profile')->with('success', 'Your profile is updated successfully!');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('index');
    }

    private function saveProfilePic(&$request, &$user) {
        // if user uploaded the file
        if($request->file('imageUpload')) {
            $imgURL = $request->file('imageUpload')->store('');
            $user->img_url = $imgURL;
        }
    }

}


