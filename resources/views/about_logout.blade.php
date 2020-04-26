
@extends('layouts.logout')
@section('title', 'About')

{{-- for sending email --}}
@section('links-in-head')
<script src='https://smtpjs.com/v3/smtp.js'></script>

@endsection



@section('nav-home', 'text-muted')
@section('nav-about', 'active')
@section('body-class', 'body-profile')


@section('content')

<div class="container about-container">
    <h1>About This Project</h1>
    <div>
        This is an employment marketplace for job seekers and employers. In traditional job finding websites, there is usually no way for job seekers to communicate with employers directly (even in linkedin, you need to make New Friend Requests to the employers first and can only chat after they accept it). However, I believe this speeds down the information exchange process. Therefore, I created this platform where employers sign up as a company (so ideally only one account per company). They post jobs here, and job seekers can directly chat in the group with the employers and even other job seekers, regarding with that specific job. This group chatting functionality will make information visible to everyone, making information spread much faster. It would be easier for job seekers to ask questions in the chatting room where every other job seekers can also see the answers. And employers can share information with every job seekers. This is gonna be great, isn't it?
    </div>
</div>

@endsection
