<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Job;

class jobController extends Controller
{
    public function show() {
        return view('post_job', [
            'user' => Auth::user()
        ]);
    }

    public function postJob(Request $request) {
        $request->validate([
            'job_title' => [
                'required'
            ],
            'job_department' => [
                'required'
            ],
            'city' => [
                'required'
            ],
            'state' => [
                'required'
            ],
            'country' => [
                'required'
            ],
            'job_description' => [
                'required',
                'max:5000'
            ],
            'responsibilities' => [
                'required',
                'array',
                'min:3'
            ],
            "responsibilities.0"  => [
                'required'
            ],
            'requirements' => [
                'required',
                'array',
                'min:3'
            ],
            "requirements.0"  => [
                'required'
            ],
            'company_description' => [
                'required',
                'max:5000'
            ],
            'application_website' => [
                'required'
            ]
        ]);


        $user = Auth::user();

        $job = new Job();
        $job->user_id = $user->id;
        $job->job_title = $request->input('job_title');
        $job->job_department = $request->input('job_department');
        $job->city = $request->input('city');
        $job->state = $request->input('state');
        $job->country = $request->input('country');
        $job->job_description = $request->input('job_description');
        $job->company_description = $request->input('company_description');
        $job->application_website = $request->input('application_website');

        $idx = 1;
        foreach($request->input('responsibilities') as $responsibility) {
            if($responsibility) {
                if($idx === 1)
                    $job->job_responsibility_1 = $responsibility;
                if($idx === 2)
                    $job->job_responsibility_2 = $responsibility;
                if($idx === 3)
                    $job->job_responsibility_3 = $responsibility;

                $idx++;
            }
        }

        $idx = 1;
        foreach($request->input('requirements') as $requirement) {
            if($requirement) {
                if($idx === 1)
                    $job->job_requirement_1 = $requirement;
                if($idx === 2)
                    $job->job_requirement_2 = $requirement;
                if($idx === 3)
                    $job->job_requirement_3 = $requirement;

                $idx++;
            }
        }

        $job->save();
        return redirect()->route('posted_jobs')->with([
            'success' => 'job is successfully posted!'
        ]);

    }



    public function showPostedJobs() {
        $user = Auth::user();


        return view('posted_jobs', [
            'user' => $user,
            'postedJobs' => $user->jobs
        ]);
    }


    public function showEditPostedJob(Request $request, Job $job) {
        $user = Auth::user();


        return view('edit_posted_job', [
            'user' => $user,
            'job' => $job
        ]);
    }

    public function editPostedJob(Request $request, Job $job) {
        $request->validate([
            'job_title' => [
                'required'
            ],
            'job_department' => [
                'required'
            ],
            'city' => [
                'required'
            ],
            'state' => [
                'required'
            ],
            'country' => [
                'required'
            ],
            'job_description' => [
                'required',
                'max:5000'
            ],
            'responsibilities' => [
                'required',
                'array',
                'min:3'
            ],
            "responsibilities.0"  => [
                'required'
            ],
            'requirements' => [
                'required',
                'array',
                'min:3'
            ],
            "requirements.0"  => [
                'required'
            ],
            'company_description' => [
                'required',
                'max:5000'
            ],
            'application_website' => [
                'required'
            ]
        ]);


        $user = Auth::user();

        $job->job_title = $request->input('job_title');
        $job->job_department = $request->input('job_department');
        $job->city = $request->input('city');
        $job->state = $request->input('state');
        $job->country = $request->input('country');
        $job->job_description = $request->input('job_description');
        $job->company_description = $request->input('company_description');
        $job->application_website = $request->input('application_website');

        $idx = 1;
        foreach($request->input('responsibilities') as $responsibility) {
            if($responsibility) {
                if($idx === 1)
                    $job->job_responsibility_1 = $responsibility;
                if($idx === 2)
                    $job->job_responsibility_2 = $responsibility;
                if($idx === 3)
                    $job->job_responsibility_3 = $responsibility;

                $idx++;
            }
        }

        $idx = 1;
        foreach($request->input('requirements') as $requirement) {
            if($requirement) {
                if($idx === 1)
                    $job->job_requirement_1 = $requirement;
                if($idx === 2)
                    $job->job_requirement_2 = $requirement;
                if($idx === 3)
                    $job->job_requirement_3 = $requirement;

                $idx++;
            }
        }

        $job->save();

        return redirect()->route("edit_posted_job", $job->id)->with([
            'success' => 'The job is successfully updated!'
        ]);
    }

    public function deletePostedJob(Request $request, Job $job) {
        $job->delete();
        return redirect()->route('posted_jobs')->with([
            'success' => 'Successfully deleted the job!'
        ]);
    }

}

