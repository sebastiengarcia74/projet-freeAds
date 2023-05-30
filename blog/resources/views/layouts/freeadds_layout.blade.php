<html>
<style>
    .navbar {
        display: flex;
        margin: 10px;
    }

    a {
        margin: 10px;
    }
</style>

<head>
    <title>Freeads - @yield('title')</title>
</head>


<body style="margin: auto;">

    <nav style="background-color: #607d8b;z-index: 950; height: 100px; display: flex; justify-content: flex-end; line-height: 64px; position: fixed; top: 0;">
        <div style="display: flex; align-items: center;" class="nav-wrapper">
            <ul class="right hide-on-med-and-down">
                <li><a href="/" class="waves-effect waves-light btn">Home</a></li>
                @if (null === Session::get('user'))
                <li><a href="/login" class="waves-effect waves-light btn">Login</a></li>
                @endif
                @if ( null !== Session::get('user'))
                <li>
                    <a href="/profile" class="waves-effect waves-light btn">Profile</a>
                </li>
                @endif
                @if (null === Session::get('user'))
                <li><a href="/registration" class="waves-effect waves-light btn">Register</a></li>
                @endif
                @if ( null !== Session::get('user'))
                @if ( Session::get('user')->admin == 1)
                <li><a href="/admin" class="waves-effect waves-light btn">Admin</a></li>
                @endif
                @endif
                @if ( null !== Session::get('user'))
                <li><a href="/logout" class="waves-effect waves-light btn">Logout</a></li>
                @endif
            </ul>
        </div>
    </nav>
    @yield('content')
</body>




</html>