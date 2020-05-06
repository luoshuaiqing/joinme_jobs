<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class testController extends Controller
{

    public function test() {
        dd(User::find(10));
    }
}
