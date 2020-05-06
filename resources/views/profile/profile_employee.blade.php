@extends('layouts.login')
@section('title', 'Profile - Employee')

{{-- for sending email --}}
@section('links-in-head')
<script src='https://smtpjs.com/v3/smtp.js'></script>
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

            <button class="btn btn-lg btn-outline-primary btn-cancel" type="button">Cancel</button>
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
            <label for="interestedCareer">Interested Career</label>
            <input class="form-control" type="text" id="interestedCareer" value="{{old('interestedCareer') ?? $user->interested_career}}" name="interestedCareer">
            @error('interestedCareer')
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
