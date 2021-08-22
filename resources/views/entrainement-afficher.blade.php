@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>
		
		@include('inc-meta')

		<title>Console | Entraînement</title>
		
	</head>
		
	<body>	
		
		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.png') }}" width="40" /></a></div>
						<div class="text-monospace small" style="color:#c5c7c9;margin-top:-2px;">console</div>
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

			<div class="container mb-5">
				<div class="row">
				
					<div class="col-md-2 pt-5">
						<a class="btn btn-light btn-sm" href="/console/entrainements" role="button"><i class="fas fa-arrow-left"></i></a>
						<div class="mt-5 text-left">
							<a class='btn btn-light btn-sm' href='/console/entrainement-modifier/{{ $entrainement_id }}' role='button'>modifier</a>
						</div>				
					</div>	
					
					<div class="col-md-10 pt-5">
					
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif	
						
						<?php
						$user = Auth::user();
						$entrainement = App\Entrainement::where([['user_id', $user->id],['id', $entrainement_id]])->first();						
						
						if ($entrainement === null){						
							?>
							<div class="text-danger text-monospace text-center">Cet entraînement n'existe pas !</div>
							<?php
						} else {
							?>
							<h1 class="mb-0">{{ $entrainement->titre }}</h1>
							<?php if ($entrainement->soustitre != '') echo '<p style="color:#84a9c7;font-style:italic;margin:-4px 0px 0px 0px;">' . $entrainement->soustitre . '</p>';?>
							<p class="mb-2 small" style="color:#bdc3c7;margin-top:-4px;">{{ date("d-m-Y", strtotime($entrainement->created_at)) }}</p>
							
							
							<div class="small text-muted pb-1">
								<i class="fa fa-link mr-2" aria-hidden="true"></i> <span class="text-monospace">www.mon-oral.net/e/{{ $entrainement->code }}</span>
							</div>
							<div class="small text-muted pb-1">
								<i class="fa fa-shield mr-2" aria-hidden="true"></i> <span class="text-monospace">{{ $entrainement->code }}</span>
							</div>		
							<div class="small text-muted pb-1">		
								<b>Préparation : </b> {{ $entrainement->temps_prep }} minutes
							</div>
							<div class="small text-muted pb-1">		
								<b>Oral : </b> {{ $entrainement->temps_oral }} minutes
							</div>							
								
							<br />
							<br />
							
							@if ($entrainement->type == 1)
								@include('inc-entrainement-afficher-type-1-2')
							@elseif ($entrainement->type == 2)
								@include('inc-entrainement-afficher-type-1-2')
							@elseif ($entrainement->type == 3)
								@include('inc-entrainement-afficher-type-3')
							@elseif ($entrainement->type == 4)
								@include('inc-entrainement-afficher-type-4')
							@elseif ($entrainement->type == 10)
								@include('inc-entrainement-afficher-type-DEV')								
							@else
								@include('inc-entrainement-afficher-type-0')
							@endif

							<?php
						}
						?>
										

					</div>
				</div>
				
			</div><!-- /container -->

		</div><!-- /app -->

		@include('inc-bottom-js')
		
		<script>
		// PRINT MODAL		
		document.getElementById("print-button").onclick = function () {
			printElement(document.getElementById("print-content"));
		};

		function printElement(elem) {
			var domClone = elem.cloneNode(true);

			var $printSection = document.getElementById("printSection");

			if (!$printSection) {
				var $printSection = document.createElement("div");
				$printSection.id = "printSection";
				document.body.appendChild($printSection);
			}

			$printSection.innerHTML = "";
			$printSection.appendChild(domClone);
			window.print();
		}	
		// /PRINT MODAL
		</script>
				
	</body>
</html>