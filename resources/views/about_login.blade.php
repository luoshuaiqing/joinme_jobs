
@extends('layouts.login')
@section('title', 'About')

{{-- for sending email --}}
@section('links-in-head')
<script src='https://smtpjs.com/v3/smtp.js'></script>

@endsection

@section('post-job')
    @if($user->is_employee == 0)
    <a href="/post_job" class="text-muted">Post Job</a>
    <a href="/posted_jobs" class="text-muted">Posted Jobs</a>
    @endif
@endsection

@section('post-job-collapse')
    @if($user->is_employee == 0)
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
    @endif
@endsection


@section('nav-search', 'text-muted')
@section('nav-chat', 'text-muted')
@section('nav-profile', 'text-muted')
@section('nav-about', 'active')
@section('nav-logout', 'text-muted')
@section('body-class', 'body-posted-jobs')


@section('content')

<div class="container about-container">
    <h1>About This Project</h1>
    <div>
        This is an employment marketplace for job seekers and employers. In traditional job finding websites, there is usually no way for job seekers to communicate with employers directly (even in linkedin, you need to make New Friend Requests to the employers first and can only chat after they accept it). However, I believe this speeds down the information exchange process. Therefore, I created this platform where employers sign up as a company (so ideally only one account per company). They post jobs here, and job seekers can directly chat with the employers, regarding with that specific job.
    </div>
</div>

@endsection
