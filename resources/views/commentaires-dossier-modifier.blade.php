@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')

		<title>Console | Modifier le dossier</title>
		
	</head>
		
	<body>	
		
		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.png') }}" width="40" /></a></div>
						<div class="text-monospace small" style="color:#c5c7c9;margin-top:-5px;">console</div>
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
							<li class="nav-item dropdown">
							
								<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									{{ Auth::user()->name }} <span class="caret"></span>
								</a>

								<div class="dropdown-menu dropdown-menu-right p-1" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="{{ route('logout') }}"
									   onclick="event.preventDefault();
													 document.getElementById('logout-form').submit();">
										{{ __('Logout') }}
									</a>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
								</div>
								
							</li>
						</ul>
					</div>
				</div>
			</nav>

			<?php
			$user = Auth::user();
			$commentaires_dossier = App\Commentaires_dossier::where([['user_id', $user->id],['id', $dossier_id]])->first();
			?>

			<div class="container mt-5">
				<div class="row">

					<div class="col-md-2">
						<a class="btn btn-light btn-sm" href="/console/commentaires" role="button"><i class="fas fa-arrow-left"></i></a>
					</div>
					
					<div class="col-md-10">

						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif		
								
						<?php
						if ($commentaires_dossier === null){
							?>
							<div class="text-danger text-monospace text-center">Ce dossier n'existe pas !</div>
							<?php
						} else {
															
							?>
						
							<h2>{{$commentaires_dossier->nom}}</h2>
							
							<form method="POST" action="{{route('commentaires-dossier-modifier-post')}}">
								
								@csrf
														
								<div class="form-row pb-3 mt-4">
									<div class="col-2 text-secondary">nom du dossier <sup style="color:red">*</sup></div>
									<div class="col">
										<input id="nom" class="form-control @error('nom') is-invalid d-block @enderror" name="nom" type="text" value="{{ old('nom', $commentaires_dossier->nom) }}" autocomplete="nom" autofocus />
										@error('nom')
											<span class="invalid-feedback d-block" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror

										<input type="hidden" name="dossier_id" value="<?php echo $dossier_id ?>">
								
										<button type="submit" class="mt-2 btn btn-primary pl-4 pr-4"><i class="fas fa-check"></i></button>
		
									</div>
								</div>	

							</form>	

							<?php

						}
						?>

					</div>
					
				</div>
				
			</div><!-- /container -->

		</div><!-- /app -->
	
		@include('inc-bottom-js')	
		
	</body>
</html>