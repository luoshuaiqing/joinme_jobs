<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


    <!-- my css for all pages, including bootstrap -->
    <link rel="stylesheet" href="{{asset('css/main.css')}}" />


	@yield('links-in-head')


</head>

<body class="@yield('body-class')">
    <div class="nav-overlay "></div>
    <nav class="nav-collapse">
        <div class="nav-collapse-toggler">
            <svg class="nav__icon-cross"><use xlink:href="{{asset('icon/sprite.svg#icon-cross')}}"></use></svg>
        </div>
        <ul class="nav__list">
            <li class="nav__item">
                <a href="/">
                    <svg class="nav__icon-home"><use xlink:href="{{asset('icon/sprite.svg#icon-home')}}"></use></svg>
                    home page
                </a>
            </li>
            <li class="nav__item">
                <a href="/about">
                    <svg class="nav__icon-about"><use xlink:href="{{asset('icon/sprite.svg#icon-users')}}"></use></svg>
                    about page
                </a>
            </li>

        </ul>
    </nav>

    <nav class="nav">
        <div class="nav-box--left">
            <a href="/" class="@yield('nav-home')" >Home</a>
        </div>
        <div class="nav-box--center">
            <span>JoinMe</span>
            <img src="{{asset('images/JoinMe.png')}}" alt="JoinMe Logo">
        </div>
        <div class="nav-box--right">
            <div>
                <a href="/about" class="@yield('nav-about')" id="about">About</a>
                <button id="menu" class="btn">Menu</button>
            </div>
        </div>

    </nav>

    @yield('content')


    @yield('js')
    {{-- my js for bootstrap --}}
    <script src="{{asset('js/app.js')}}"></script>

    <script>

        $('#menu').click(function() {
            $('.nav-overlay').css('display', 'block');
            $('.nav-overlay').animate({opacity: 1}, 'fast', function() {
                $('.nav-collapse').animate({width: "+=100vw", opacity: 1}, 'fast');

            });
        });

        $('.nav-collapse-toggler').click(() => {
            $('.nav-overlay').animate({opacity: 0}, 0, function() {
                $('.nav-collapse').animate({width: "-=100vw", opacity: 0}, 0);
            });
            $('.nav-overlay').css('display', 'none');
        });

        $('#menu').click(() => {
            $('.nav-collapse').show();
        });

    </script>
</body>

</html>
