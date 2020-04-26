@extends('layouts.logout')
@section('title', 'Welcom to JoinMe')

{{-- for sending email --}}
@section('links-in-head')
<script src='https://smtpjs.com/v3/smtp.js'></script>

@endsection


@section('nav-home', 'active')
@section('nav-about', 'text-muted')

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
            <form action="/login" method="POST" id="login-form">
                @csrf
                <header class="header w-100">
                    Account Login
                </header>
                <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="login-email" name="email"
                        placeholder="Email Address" value="{{old('email')}}" required>
                    <label for="login-email">Email Address</label>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="login-password" name="password"
                        placeholder="Password" value="{{old('password')}}" required>
                    <label for="login-password">Password</label>
                    <div class="error-box">
                        <span class="error text-red" id="login__error">
                            @if(session('errors'))
                                {{$errors->first()}}
                            @elseif(session('loginError'))
                                {{session('loginError')}}
                            @endif

                        </span>
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
                    <label for="signup-password">Password</label>
                </div>



                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="verification-code" name="verificationCode"
                        placeholder="Verification Code" required>
                    <div class="btn-send">send</div>
                    <label for="verification-code">Verification Code</label>
                    <div class="error-box">

                        <span class="error text-red" id="signup__error"></span>

                        <a href="#" class="index-toggle-display" >Log In?</a>
                    </div>
                </div>

                <div class="signup-btn-container">
                    <a href="#" class="submit submit-signup as-employee">Employee</a>
                    <a href="#" class="submit submit-signup as-employer">Employer</a>
                </div>


            </form>
        </div>
    </div>


</div>



@endsection


@section('js')
<script src="{{asset('js/index.js')}}"></script>

@endsection
