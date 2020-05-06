@extends('layouts.login')
@section('title', 'Posted Jobs')

{{-- for sending email --}}
@section('links-in-head')
<script src='https://smtpjs.com/v3/smtp.js'></script>

@endsection

@section('post-job')
<a href="/post_job" class="text-muted">Post Job</a>
<a href="/posted_jobs" class="active">Posted Jobs</a>
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
@section('body-class', 'body-posted-jobs')


@section('content')
<form class="posted-jobs-container container" action="#" method="post">
    @csrf
    @if(session('success'))
        <h3 class="text-success mt-5">{{session('success')}}</h3>
    @endif
    <h1>
        Posted Jobs
    </h1>
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Job Title</th>
                <th scope="col">Job Department</th>
                <th scope="col">City</th>
                <th scope="col">State</th>
                <th scope="col">Country</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($postedJobs as $postedJob)
                <tr>
                    <th scope="row">{{$i++}}</th>
                    <td>{{$postedJob->job_title}}</td>
                    <td>{{$postedJob->job_department}}</td>
                    <td>{{$postedJob->city}}</td>
                    <td>{{$postedJob->state}}</td>
                    <td>{{$postedJob->country}}</td>
                    <td><a href="/posted_jobs/{{$postedJob->id}}" class="btn btn-primary btn-lg">Edit</a></td>
                    <td><button class="btn btn-danger btn-lg btn-delete" type="submit" data-job-id="{{$postedJob->id}}">Delete</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

</form>

<script>
    $('.btn-delete').click(function(e) {
        e.preventDefault();
        let jobId = $(this).attr('data-job-id');
        $('form').attr('action', '/delete_posted_job/' + jobId);
        $('form').submit();
    })


</script>
@endsection
