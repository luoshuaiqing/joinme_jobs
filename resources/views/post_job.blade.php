@extends('layouts.login')
@section('title', 'Post a New Job')

{{-- for sending email --}}
@section('links-in-head')
<script src='https://smtpjs.com/v3/smtp.js'></script>

@endsection

@section('post-job')
<a href="/post_job" class="active">Post Job</a>
<a href="/posted_jobs" class="text-muted">Posted Jobs</a>
@endsection

@section('post-job-collapse')
<li class="nav__item">
    <a href="/post_job">
        <svg class="nav__icon-post-job">
            <use xlink:href="{{secure_asset('icon/sprite.svg#icon-pencil')}}"></use>
        </svg>
        post job page
    </a>
</li>
<li class="nav__item">
    <a href="/posted_jobs">
        <svg class="nav__icon-posted-jobs">
            <use xlink:href="{{secure_asset('icon/sprite.svg#icon-office')}}"></use>
        </svg>
        posted jobs
    </a>
</li>
@endsection


@section('nav-search', 'text-muted')
@section('nav-chat', 'text-muted')
@section('nav-profile', 'text-muted')
@section('nav-about', 'text-muted')
@section('nav-logout', 'text-muted')
@section('body-class', 'body-post-job')


@php
    // dd($errors);
@endphp


@section('content')
<div class="post-job-container container">
    <form method="POST" action="/post_job">
        @csrf
        <h1 class="mb-4 text-center">Tell Me About Your Job</h1>
        <div class="form-row ">
            <div class="col-6 form-group">
                <label for="job_title">Job Title</label>
                <input type="text" class="form-control form-control-lg" name="job_title" id="job_title" value="{{old('job_title')}}" required>
                @error("job_title")
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-6 form-group">
                <label for="job_department">Job Department</label>
                <input type="text" class="form-control form-control-lg" name="job_department" id="job_department" value="{{old('job_department')}}" required>
                @error("job_department")
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class='form-row'>
            <div class="col-4 form-group">
                <label for="city">City</label>
                <input type="text" class="form-control form-control-lg city_tags" name="city" id="city" value="{{old('city')}}" required>
                @error("city")
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-4 form-group">
                <label for="state">State</label>
                <input type="text" class="form-control form-control-lg" value="{{old('state')}}" name="state" id="state" required>
                @error("state")
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-4 form-group ">
                <label for="country">Country</label>
                <input type="text" class="form-control form-control-lg country_tags" name="country" id="country" value="{{old('country')}}" required>
                @error("country")
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class='form-row'>
            <div class="col-12 form-group ">
                <label for="job_description">Job Description</label>
                <textarea class="form-control form-control-lg" id="job_description" name="job_description" rows="3"
                    aria-describedby="job_description_word_limit" required>{{old('job_description')}}</textarea>
                <small id="job_description_word_limit" class="form-text text-muted">
                    You can not have more than 5000 characters in job description.
                </small>
                @error("job_description")
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="form-row" id="responsibilities_div">
            <div class="col-12 mb-1">
                <label>What are the major responsibilities of the candidates</label>

                <button class="btn btn-primary add" onclick="add_responsibility()">Add</button></div>

            <div class="col-4 form-group input-group input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text">1.</span>
                </div>
                <input type="text" class="form-control form-control-lg" name="responsibilities[]" value="{{old('responsibilities.0')}}" required>
            </div>
            <div class="col-4 form-group input-group input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text">2.</span>
                </div>
                <input type="text" class="form-control form-control-lg" name="responsibilities[]" value="{{old('responsibilities.1')}}" >
            </div>
            <div class="col-4 form-group input-group input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text">3.</span>
                </div>
                <input type="text" class="form-control form-control-lg" name="responsibilities[]" value="{{old('responsibilities.2')}}" >
            </div>
        </div>
        @error("responsibilities.0")
            <small class="text-danger">Please fill the first blank for the job responsibility!</small>
        @enderror
        <div class="form-row" id="requirements_div">
            <div class="col-12 mb-1 add-container">
                <label>What skills/characteristics do you require from the
                    candidates</label>

                <button class="btn btn-primary add" onclick="add_requirement()">Add</button>
            </div>
            <div class="col-4 form-group input-group input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text">1.</span>
                </div>
                <input type="text" class="form-control form-control-lg" name="requirements[]" value="{{old('requirements.0')}}" required>
            </div>
            <div class="col-4 form-group input-group input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text">2.</span>
                </div>
                <input type="text" class="form-control form-control-lg" name="requirements[]"  value="{{old('requirements.1')}}" >
            </div>
            <div class="col-4 form-group input-group input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text">3.</span>
                </div>
                <input type="text" class="form-control form-control-lg" name="requirements[]"  value="{{old('requirements.2')}}" >
            </div>
        </div>
        @error("requirements.0")
            <small class="text-danger">Please fill the first blank for the job requirement!</small>
        @enderror
        <div class='form-row'>
            <div class="col-12 form-group">
                <label for="company_description">Company Description</label>
                <textarea class="form-control form-control-lg" id="company_description" rows="3"
                    aria-describedby="company_description_word_limit"  name="company_description" required>{{old('company_description')}}</textarea>
                <small id="company_description_word_limit" class="form-text text-muted">
                    You can not have more than 5000 characters in company description.
                </small>
                @error("company_description")
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-12 form-group">
                <label for="job_apply_url">Application Website</label>
                <input type="text" class="form-control form-control-lg" name="application_website" value="{{old('application_website')}}" required>
                @error("application_website")
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div id="post_div" class="text-right mb-3">
            <button class="btn btn-lg btn-primary" id="post_button" type="submit">Post Now!</button>
        </div>
    </form>
</div>

@endsection
