<nav class="navbar navbar-expand-md navbar-light mt-2 mb-4">
	<div class="container">
		<div>
			<div class="float-left"><a href="{{ url('/console/') }}"><img src="{{ asset('img/mon-oral.svg') }}" width="40" /></a></div>
			<div class="float-left text-monospace small pl-3" style="color:#c5c7c9;">Console</div>
		</div>		

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Left Side Of Navbar -->
			<ul class="navbar-nav mr-auto">

			</ul>

			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ml-auto">
				<!-- Authentication Links -->
				@guest
					<li class="nav-item">
						<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
					</li>
					@if (Route::has('register'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
						</li>
					@endif
				@else
					<li class="nav-item dropdown">
						<a id="navbarDropdown" class="nav-link dropdown-toggle small" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							{{ Auth::user()->name }} <span class="caret"></span>
						</a>

						<div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="navbarDropdown">

							<table class="mr-2 mb-2 text-monospace small text-muted">
								<tr>
									<td class="text-center pr-2 align-top pt-1"><i class="fas fa-building"></i></td>
									<td class="pt-1">{{ Auth::user()->etablissement }}</td>
								</tr>
								<tr>
									<td class="text-center pr-2 align-top pt-1"><i class="fas fa-bookmark"></i></td>
									<td class="pt-1">{{ Auth::user()->matiere }}</td>
								</tr>
								<tr>
									<td class="text-center pr-2 align-top pt-1"><i class="fas fa-at"></i></td>
									<td class="pt-1">{{ Auth::user()->email }}</td>
								</tr>
							</table>

							<a class="dropdown-item btn btn-light text-center" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="small">{{ __('Logout') }}</span></a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
					</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>
