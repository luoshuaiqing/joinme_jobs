@extends('layouts.main')
@section('title', 'Welcom to JoinMe')

{{-- for sending email --}}
@section('links-in-head')
<script src='https://smtpjs.com/v3/smtp.js'></script>
@endsection


{{-- @section('nav-home-active', 'active')
@section('nav-search-active', 'text-muted ')
@section('nav-chat-active', 'text-muted ') --}}


@section('content')

<div class="container-fluid index-container">

    <div class="bg-video">
        <video class="bg-video__content" autoplay muted loop>
            {{-- <source src="{{asset('video/index_bg_video.mp4')}}" type="video/mp4">
			<source src="{{asset('video/index_bg_video.webm')}}" type="video/mp4"> --}}
			<source src="{{asset('video/video1.mp4')}}" type="video/mp4">
            Your browser is not supported!
        </video>
    </div>

    <div class="row h-100">
        <div class="col-md-6 col-12 index-container__login ">
            <form action="">
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

                <a href="#" class="submit">Login</a>

            </form>
        </div>
        <div class="col-md-6 col-12 index-container__signup">
            <form action="">
                <header class="header w-100">
                    Account Signup
                </header>
                <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="signup-email"
                        placeholder="Email Address" required>
                    <label for="signup-email">Email Address</label>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="signup-password"
                        placeholder="Password" required>
                    <label for="signup-password">Password </label>

                </div>

                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="verification-code"
                        placeholder="Verification Code" required>
                    <div class="btn-send">send</div>
                    <label for="verification-code">Verification Code </label>
                    <div class="error-box">
                        <span class="error text-red" id="signup__error">Please enter the correct verification
                            code</span>
                        <a href="#" class="index-toggle-display">Log In?</a>
                    </div>
                </div>

                <a href="#" class="submit">Sign Up</a>

            </form>
        </div>
    </div>


</div>



@endsection


@section('js')
<script>
	$("video")[0].playbackRate = .3;
	
    

    let loginShowed = true;
    $('.index-toggle-display').click(() => {
        if (loginShowed) {
            $(".index-container__login > form").css("display", "none");
            $(".index-container__signup > form").fadeIn(1000);
        } else {
            $(".index-container__signup > form").css("display", "none");
            $(".index-container__login > form").fadeIn(1000);
        }
        loginShowed = !loginShowed;
	});
	
	$('.index-container__signup .btn-send').click(() => {
		alert('email sent');
	})

</script>

@endsection
