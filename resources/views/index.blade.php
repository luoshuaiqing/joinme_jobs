@extends('layouts.logout')
@section('title', 'Welcom to JoinMe')

{{-- for sending email --}}
@section('links-in-head')
<script src='https://smtpjs.com/v3/smtp.js'></script>

@endsection


@section('nav-home', 'active')
@section('nav-search', 'text-muted')
@section('nav-chat', 'text-muted')

@section('content')

<div class="container-fluid index-container">

    <div class="bg-video">
        <video class="bg-video__content" autoplay muted loop>
			<source src="{{asset('video/video1.mp4')}}" type="video/mp4">
            Your browser is not supported!
        </video>
    </div>

    <div class="row h-100">
        <div class="col-md-6 col-12 index-container__login ">
            <form action="#" method="POST" id="login-form">
                @csrf
                <header class="header w-100">
                    Account Login
                </header>
                <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="login-email"
                        placeholder="Email Address" required>
                    <label for="login-email">Email Address</label>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="login-password"
                        placeholder="Password" required>
                    <label for="login-password">Password </label>
                    <div class="error-box">
                        <span class="error text-red" id="login__error">Please enter the correct email and
                            password</span>
                        <a href="#" class="index-toggle-display">Sign Up?</a>
                    </div>
                </div>

                <a href="#" class="submit submit-login">Login</a>

            </form>
        </div>


        <div class="col-md-6 col-12 index-container__signup">
            <form action="#" method="POST" id="signup-form">
                @csrf
                <header class="header w-100">
                    Account Signup
                </header>
                <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="signup-email"
                        placeholder="Email Address" name="email" required>
                    <label for="signup-email">Email Address</label>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="signup-password"
                        placeholder="Password" name="password" required>
                    <label for="signup-password">Password </label>

                </div>

                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="verification-code" name="verification-code"
                        placeholder="Verification Code" required>
                    <div class="btn-send">send</div>
                    <label for="verification-code">Verification Code</label>
                    <div class="error-box">

                        <span class="error text-red" id="signup__error">{{$errors->first()}}</span>

                        <a href="#" class="index-toggle-display" >Log In?</a>
                    </div>
                </div>

                <a href="#" class="submit submit-signup" type="submit">Sign Up</a>

            </form>
        </div>
    </div>


</div>



@endsection


@section('js')
<script src="{{asset('js/index.js')}}"></script>

@endsection
