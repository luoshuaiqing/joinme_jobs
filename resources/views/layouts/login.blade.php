<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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
                <a href="/search">
                    <svg class="nav__icon-search"><use xlink:href="{{asset('icon/sprite.svg#icon-profile')}}"></use></svg>
                    search page
                </a>
            </li>
            <li class="nav__item">
                <a href="/chat">
                    <svg class="nav__icon-chat"><use xlink:href="{{asset('icon/sprite.svg#icon-bubbles')}}"></use></svg>
                    chat page
                </a>
            </li>
            <li class="nav__item">
                <a href="/profile">
                    <svg class="nav__icon-profile"><use xlink:href="{{asset('icon/sprite.svg#icon-profile')}}"></use></svg>
                    profile page
                </a>
            </li>
            <li class="nav__item">
                <a href="/about">
                    <svg class="nav__icon-about"><use xlink:href="{{asset('icon/sprite.svg#icon-users')}}"></use></svg>
                    about page
                </a>
            </li>
            <li class="nav__item">
                <a href="/logout">
                    <svg class="nav__icon-logout"><use xlink:href="{{asset('icon/sprite.svg#icon-cancel-circle')}}"></use></svg>
                    log out
                </a>
            </li>
        </ul>
    </nav>

    <nav class="nav">
        <div class="nav-box--left">
            <a href="/search" class="@yield('nav-search') " >Search</a>
            <a href="/chat" class="@yield('nav-chat') ">Chat</a>
            <a href="/profile" class="@yield('nav-profile') ">Profile</a>

        </div>
        <div class="nav-box--center">
            <span>JoinMe</span>
            <img src="{{asset('img/JoinMe.png')}}" alt="JoinMe Logo">
        </div>
        <div class="nav-box--right">
            <div>
                <a href="/about" class="@yield('nav-about')" id="about">About</a>
                <a href="/logout" class="@yield('nav-logout')" id="logout">Log Out</a>
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
