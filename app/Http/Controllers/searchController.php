<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Job;

class searchController extends Controller
{
    public function show() {
        return view('search');
    }


    public function searchFor(Request $request) {
        $term = $request->query('term');

        $results = Job::select('jobs.*', 'users.img_url', 'users.company_name')
                    ->join('users', 'users.id', '=', 'jobs.user_id')
                    ->where('job_title', 'like', "%$term%")
                    ->orWhere('job_department', 'like', "%$term%")
                    ->orWhere('city', 'like', "%$term%")
                    ->orWhere('state', 'like', "%$term%")
                    ->orWhere('country', 'like', "%$term%")
                    ->orWhere('job_department', 'like', "%$term%")
                    ->orWhere('job_description', 'like', "%$term%")
                    ->orWhere('company_description', 'like', "%$term%")
                    ->orWhere('job_requirement_1', 'like', "%$term%")
                    ->orWhere('job_requirement_2', 'like', "%$term%")
                    ->orWhere('job_requirement_3', 'like', "%$term%")
                    ->orWhere('job_responsibility_1', 'like', "%$term%")
                    ->orWhere('job_responsibility_2', 'like', "%$term%")
                    ->orWhere('job_responsibility_3', 'like', "%$term%")
                    ->get();


        return response()->json(
            $results
        );

    }

    public function searchForDetail(Request $request) {
        $id = $request->query('id');

        $results = Job::select('jobs.*', 'users.img_url', 'users.company_name')
                    ->join('users', 'users.id', '=', 'jobs.user_id')
                    ->where('jobs.id', '=', $id)
                    ->get();

        return response()->json(
            $results
        );

    }

}
