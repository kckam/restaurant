<!DOCTYPE html>
<html class="preload">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
	<title>Restaurant</title>
</head>
<body>
	<section class="header">
		<nav class="container">
			<ul class="left">
				<li><a href="{{ route('homepage') }}">Home</a></li>
				@if (Auth::user())
				<li><a href="{{ route('list_restautant') }}">List restaurant</a></li>
				@endif
			</ul>

			<ul class="right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                            </li>

                         	<li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endif
                    </ul>
		</nav>
	</section>

	<main class="container">
		@yield('content')
	</main>
</body>
</html>