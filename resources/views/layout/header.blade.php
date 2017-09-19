<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
	<title>{{$title}}</title>
</head>
<body>
	<section class="header">
		<nav class="container">
			<ul>
				<li>List restaurant</li>
			</ul>
		</nav>
	</section>

	<main class="container">
		@yield('content')
	</main>
</body>
</html>