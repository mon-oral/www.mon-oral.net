@include('inc-top')
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">		

    <title>Mon Oral</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script>-->
	
	<!-- Font Awesome -->
	<script src="https://kit.fontawesome.com/cbfbfc2c41.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
	
	<!-- Material Icons -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div id="app">
	
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.png') }}" width="60" /></a></div>
						<div class="text-monospace" style="font-size:60%;color:silver;margin-top:-6px;">mon-oral.net</div>
						<div class="text-monospace small text-danger" style="padding-left:70px;margin-top:-70px;">bêta</div>
					</div>
					
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<!-- Left Side Of Navbar -->
						<ul class="navbar-nav mr-auto">

						</ul>

						<!-- Right Side Of Navbar -->
						<!--
						<ul class="navbar-nav ml-auto">
							@if (Route::has('login'))				
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle text-muted" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-lock"></i></a>
									<div class="dropdown-menu m-0 p-0" aria-labelledby="navbarDropdownMenuLink">
										<div class="text-center small p-2" style="color:#227dc7;"><b>accès enseignants</b></div>
										@auth
											<a class="dropdown-item" href="{{ url('/console') }}">console</a>
										@else
											<a class="dropdown-item" href="{{ route('login') }}">se connecter</a>
											@if (Route::has('register'))
												<a class="dropdown-item" href="{{ route('register') }}">s'inscrire</a>
											@endif
										@endauth
									</div>
								</li>						
							@endif				
						</ul>
						-->
					</div>
				</div>
			</nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
	
	@include('inc-bottom')	
	@include('inc-bottom-js')	
	
</body>
</html>
