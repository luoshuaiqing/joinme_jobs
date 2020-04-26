@extends('layouts.login')
@section('title', 'Profile - Employer')

{{-- for sending email --}}
@section('links-in-head')
<script src='https://smtpjs.com/v3/smtp.js'></script>


@endsection

@section('post-job')
<a href="/post_job" class="text-muted">Post Job</a>
<a href="/posted_jobs" class="text-muted">Posted Jobs</a>
@endsection

@section('post-job-collapse')
<li class="nav__item">
    <a href="/post_job">
        <svg class="nav__icon-post-job">
            <use xlink:href="{{asset('icon/sprite.svg#icon-pencil')}}"></use>
        </svg>
        post job page
    </a>
</li>
<li class="nav__item">
    <a href="/posted_jobs">
        <svg class="nav__icon-posted-jobs">
            <use xlink:href="{{asset('icon/sprite.svg#icon-office')}}"></use>
        </svg>
        posted jobs
    </a>
</li>
@endsection


@section('nav-search', 'text-muted')
@section('nav-chat', 'text-muted')
@section('nav-profile', 'active')
@section('nav-about', 'text-muted')
@section('nav-logout', 'text-muted')
@section('body-class', 'body-profile')

@section('content')


<div class="profile-container container">
    @if(session('success'))
        <h3 class="text-success mt-5">{{session('success')}}</h3>
    @endif
    <img src="{{asset("user_photos/{$user->img_url}")}}" alt="user profile photo" class="user-photo">

    <form action="/profile" method="POST" class="container-fluid edit-profile-container" enctype="multipart/form-data">
        @csrf

        <div class="header-container">
            <h1>Edit Profile</h1>

            <button class="btn btn-lg btn-outline-primary btn-cancel">Cancel</button>
            <button class="btn btn-lg btn-primary">Save</button>
        </div>

        <div class="form-group ">
            <label for="firstName">First Name</label>
            <input class="form-control" type="text" id="firstName" value="{{old('firstName') ?? $user->first_name}}" name="firstName" required>
            @error('firstName')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input class="form-control" type="text" id="lastName" value="{{old('lastName') ?? $user->last_name}}" name="lastName" required>
            @error('lastName')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <input class="form-control" type="text" id="gender" value="{{old('gender') ?? $user->gender}}" name="gender">
            @error('gender')
                <small class="text-danger">Please indicate whether you are male or female</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="companyName">Company Name</label>
            <input class="form-control" type="text" id="companyName" value="{{old('companyName') ?? $user->company_name}}" name="companyName" required>
            @error('companyName')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="imageUpload">Image Upload</label>
            <input type="file" class="form-control-file" id="imageUpload" accept="image/*" name="imageUpload">
            @error('imageUpload')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </form>


</div>

@endsection


@section('js')


<script src="{{asset('js/profile.js')}}"></script>

@endsection
