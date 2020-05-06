@extends('layouts.login')
@section('title', 'Search Jobs')

{{-- for sending email --}}
@section('links-in-head')
<script src='https://smtpjs.com/v3/smtp.js'></script>

@endsection

@section('post-job')
    @if(Auth::check() && Auth::user()->is_employee == 0)
    <a href="/post_job" class="text-muted">Post Job</a>
    <a href="/posted_jobs" class="text-muted">Posted Jobs</a>
    @endif
@endsection

@section('post-job-collapse')
    @if(Auth::check() && Auth::user()->is_employee == 0)
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


@section('nav-search', 'active')
@section('nav-chat', 'text-muted')
@section('nav-profile', 'text-muted')
@section('nav-about', 'text-muted')
@section('nav-logout', 'text-muted')



@section('content')



<form>
    <div class="container-fluid search_div">
        <div class="active-cyan-4 mb-4">
            <h1 class="">What are you looking for...</h1>
            <input class="form-control" type="text" placeholder="Software Engineer..." id="search_input">
            <button class="btn btn-primary btn-lg" id="search_button" style="margin-top: 15px;">Search!</button>
            <h1 class="text-danger mt-2 hidden" id="no-results">There are no matching results! Please try another keyword!</h1>
        </div>
    </div>
</form>
<hr style="margin-top:0px;">
<div class="container-fluid">
    <div class="row  bottom_part">
        <div class="col-md-4 col-12 left_col" id="left_col">

            <!-- <div class="job_box">
                <span class="job_title "><img class="logo" src="secure_assets/company_images/amazon.png">&nbsp;<span class="clickable text_center" onclick="show_detail(this);">Software Engineer</span></span>
                <i class="far fa-star fa-lg fav" ></i>

                <p class=""><i class="far fa-building"></i>&nbsp;<span>Amazon</span><i class="fas fa-map-marker-alt location_icon"></i>&nbsp;<span>San Diego</span>, <span>CA</span></p>

                <p class="description "><span>The Software Engineer III works in the MINDBODY software development life cycle, including specification, design, implementation and testing of new features and bug fixing. The Software Engineer III is responsible for their ow....</span></p>
            </div> -->

        </div>
        <div class="col-md-8 col-12 right_col">
            <div class="job_detail_box" id="job_detail_box">

                <!-- <h3 style="text-align: center;">Please choose a job on the left to show job detail.</h3> -->
                <!-- <div class="job_title_2">
                    <span class=""><img alt="xxx" class="logo_2" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmxScH-JaDVF6ZNAloBdqD5q2YcJ79-vrS09QU8EA3Xe58Tart">&nbsp;<span class="text_center">Software Engineer</span></span>
                </div>

                <p class="company_and_location"><i class="far fa-building"></i>&nbsp;<span>Apple</span><i class="fas fa-map-marker-alt location_icon_2"></i>&nbsp;<span>Santa Clara</span>, <span>CA</span></p>


                <div class="description_2">
                    <p class=" margin_bottom_25"><span id="div_1">Job Description</span>
                        <br/> <span>Are you passionate about changing the world? We have a critical impact on getting high quality functional products to millions of customers quickly and we are hiring all levels from junior to senior roles. As part of the silicon validation team, you will develop Linux device drivers and user-land tests for exercising and testing the various subsystems in complex SoCs.</span>
                    </p>

                    <span id="div_2">Here's What You'll Do</span>
                    <ul class=" margin_bottom_25">
                        <li>You will be developing Linux device drivers and user-land tests for exercising and testing the various subsystems in complex SoCs.</li>
                        <li>You will be implementing BSP and doing software bringup on pre and post-silicon platforms</li>
                        <li>You will debug and root-cause a variety of hardware and software issues</li>
                    </ul>

                    <span id="div_3">Here's What We Are Looking For</span>
                    <ul class=" margin_bottom_25">
                        <li>5+ years of embedded Linux kernel development experience</li>
                        <li>Proven knowledge of Linux kernel internals (process scheduler, memory management, concurrency/synchronization, memory allocation, file systems) and networking or storage subsystems architecture</li>
                        <li>Extensive device driver development and support (one or more of USB, network, graphics, video, mtd, storage, and power management)</li>
                    </ul>

                    <p class=""><span id="div_4">About Us</span>
                        <br/> <span>At Apple, new ideas have a way of becoming extraordinary products, services, and customer experiences very quickly. Bring passion and dedication to your job and there's no telling what you could accomplish. Dynamic, smart people and inspiring, innovative technologies are the norm here. The people who work here have reinvented entire industries with all Apple Hardware products. The same passion for innovation that goes into our products also applies to our practices strengthening our commitment to leave the world better than we found it. Join us to help deliver the next groundbreaking Apple product.</span>
                    </p>

                    <div class="button_div ">
                        <a href="https://www.glassdoor.com/Job/jobs.htm?suggestCount=0&suggestChosen=true&clickSource=searchBtn&typed" role="button" class=" animsition-link btn btn-outline-primary btn-lg apply" >Apply Now</a>
                        <a role="button" class="btn btn-outline-success btn-lg chat" onclick="start_chat();">Start Chat</a>
                    </div>


                </div> -->

            </div>
        </div>
    </div>
</div>

<script src="https://kit.fontawesome.com/cff48e921f.js" crossorigin="anonymous"></script>
<script type="text/javascript">
    search_helper(false);

    let last_selected_box = null;

    // initialize clicked_job_id to null
    let clicked_job_id = null;


    function ajaxGet(endpointUrl, returnFunction) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', endpointUrl, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                if (xhr.status == 200) {
                    // When ajax call is complete, call this function, pass a string with the response
                    returnFunction(xhr.responseText);
                } else {
                    alert('here! AJAX Error.');
                    console.log(xhr.status);
                }
            }
        }
        xhr.send();
    }





    function show_detail(e) {

        e = e.parentNode.parentNode;

        e.classList.toggle("selected_box");
        if (last_selected_box != null) {
            last_selected_box.classList.toggle("selected_box");
        }
        last_selected_box = e;

        clicked_job_id = e.id.substring(1);

        ajaxGet("/searchForDetail?id=" + clicked_job_id, function (results) {

            // This function gets run when backend.php returns something
            results = JSON.parse(results);

            let resultsList = $("#job_detail_box");

            resultsList.empty();
            console.log(results);

            results.forEach((result) => {
                let job_title = result.job_title;
                let company_description = result.company_description;
                let city = result.city;
                let company_name = $("#_" + clicked_job_id + " .company_name_class").text();
                let application_website = result.application_website;
                let country = result.country;
                let job_description = result.job_description;
                let state = result.state;
                let job_id = result.id;
                let responsibilities = [result.job_responsibility_1, result.job_responsibility_2, result.job_responsibility_3];
                let requirements = [result.job_requirement_1, result.job_requirement_2, result.job_requirement_3];
                let image_url = $("#" + e.id).find('img').attr('src');

                createJobDetailDiv(resultsList, job_title, company_description, city, company_name,
                    application_website, country, job_description, state, job_id, responsibilities,
                    requirements, image_url);
            });
        });
    }



    document.getElementById("search_button").onclick = function () {
        event.preventDefault();
        search_helper();
    }

    let start_chat = () => {
        event.preventDefault();
        window.location.href = "messages/" + clicked_job_id;
    }

    function search_helper(to_clear = true) {
        // Grab what the user typed in
        let searchInput = document.querySelector("#search_input").value.trim();

        // Make a GET request via AJAX, pass in the search term that the user typed in
        ajaxGet("/searchFor?term=" + searchInput, function (results) {

            // This function gets run when backend.php returns something
            if (results == null || results == "" || results.length == 0) {
                console.log(
                    "Nothing is returned back. Either it is because no records match the searchInput or because there is non-UTF8 characters in the record that we want to return."
                    );
                return;
            }
            results = JSON.parse(results);


            let resultsList = $("#left_col");

            resultsList.empty();
            if (to_clear) {
                $("#job_detail_box").empty();
            }

            console.log(results);
            var first_one = true;
            if(results.length === 0) {
                $('#no-results').show();
            }
            else {
                $('#no-results').hide();
            }

            results.forEach((result) => {
                let job_title = result.job_title;
                let company_description = result.company_description;
                let city = result.city;
                let company_name = result.company_name;
                let application_website = result.application_website;
                let country = result.country;
                let job_description = result.job_description;
                let state = result.state;
                let job_id = result.id;
                let image_url = "{{secure_asset("user_photos")}}" + "/" + result.img_url;

                resultsList.append('<div class="job_box" id="_' + job_id +
                    '"><span class="job_title  "><img class="logo" alt="xxx" src="' +
                    image_url +
                    '">&nbsp;<span class="clickable text_center text-capitalize" onclick="show_detail(this);">' +
                    job_title +
                    '</span></span><p class=""><i class="far fa-building"></i>&nbsp;<span class="text-capitalize company_name_class">' +
                    company_name +
                    '</span><i class="fas fa-map-marker-alt location_icon"></i>&nbsp;<span class="text-capitalize">' +
                    city + '</span>, <span class="text-capitalize">' + state +
                    '</span></p><p class="description "><span>' + job_description +
                    '</span></p></div>');

                if (first_one) {
                    show_detail($(".clickable")[0]);
                    first_one = false;
                }
            });

        });
    }

    function createJobDetailDiv(resultsList, job_title, company_description, city, company_name, application_website,
        country, job_description, state, job_id, responsibilities, requirements, image_url) {
        let str_1 = '<div class="job_title_2"><span class=""><img alt="xxx" class="logo_2" src="' + image_url +
            '">&nbsp;<span class="text_center text-capitalize">' + job_title + '</span></span></div>';

        let str_2 =
            '<p class="company_and_location "><i class="far fa-building"></i>&nbsp;<span class="text-capitalize">' +
            company_name +
            '</span><i class="fas fa-map-marker-alt location_icon_2"></i>&nbsp;<span class="text-capitalize">' + city +
            '</span>, <span class="text-capitalize">' + state + '</span></p>';

        let str_3 =
            '<div class="description_2"><p class="margin_bottom_25"><span id="div_1" class="header-2">Job Description</span><span>' +
            job_description + '</span></p>';

        let str_4 = '<span id="div_2" class="header-2">Here\'s What You\'ll Do</span><ul class=" margin_bottom_25">';

        let str_5 = '';
        responsibilities.forEach((responsibility) => {
            if (responsibility && responsibility.trim().length > 0) {
                str_5 += '<li class="text-capitalize">' + responsibility + '</li>';
            }
        });
        str_5 += '</ul>';

        let str_6 =
            '<span id="div_3" class="header-2">Here\'s What We Are Looking For</span><ul class=" margin_bottom_25">';
        let str_7 = '';
        requirements.forEach((requirement) => {
            if (requirement && requirement.trim().length > 0) {
                str_7 += '<li class="text-capitalize">' + requirement + '</li>';
            }

        });
        str_7 += '</ul>';


        let str_8 = '<p class=""><span id="div_4" class="header-2">About Us</span> <span>' + company_description +
            '</span></p>';

        let str_9 = '<div class="button_div "><a href="' + application_website +
            '" role="button" class="animsition-link  btn btn-outline-primary btn-lg apply" >Apply Now</a><a role="button" class="btn btn-outline-success btn-lg chat" onclick="start_chat();">Start Chat</a></div>';

        let str_10 = '</div>';

        resultsList.append(str_1 + str_2 + str_3 + str_4 + str_5 + str_6 + str_7 + str_8 + str_9 + str_10);


    }

</script>



@endsection
