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

@section('body-class', 'body-profile')

@section('content')



<div class="profile-container container">
    <img src="{{$photoUrl}}" alt="user photo">


    <form action="/profile" method="POST" class="container-fluid edit-profile-container" enctype="multipart/form-data">
        @csrf
        @if(session('signupSuccess'))
            <h3 class="text-success mt-3">{{session('signupSuccess')}}</h3>
        @endif
        <div class="header-container">
            <h1>Edit Profile</h1>
            <button class="btn btn-lg btn-outline-primary btn-cancel">Cancel</button>
            <button class="btn btn-lg btn-primary">Save</button>
        </div>

        <div class="form-group ">
            <label for="firstName">First Name</label>
            <input class="form-control" type="text" id="firstName" value="{{$firstName}}" name="firstName" required>
        </div>
        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input class="form-control" type="text" id="lastName" value="{{$lastName}}" name="lastName" required>
        </div>
        <div class="form-group">
            <label for="imageUpload">Image Upload</label>
            <input type="file" class="form-control-file" id="imageUpload" accept="image/*" name="imageUpload">
        </div>
    </form>


</div>

@endsection


@section('js')
<script src="{{asset('js/profile.js')}}"></script>

@endsection
