@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')

		<title>Console | Modifier le commentaire</title>
		
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
			$commentaire = App\Commentaire::where([['user_id', $user->id],['id', $commentaire_id]])->first();
			$commentaires_dossiers = App\Commentaires_dossier::where([['user_id', $user->id]])->get();
			//echo $commentaire->dossier;
			?>

			<div class="container">
				<div class="row">

					<div class="col-md-2 pt-5">
						<a class="btn btn-light btn-sm" href="/console/commentaires" role="button"><i class="fas fa-arrow-left"></i></a>
					</div>
					
					<div class="col-md-10 pt-5">

						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif		
								
						<?php
						if ($commentaire === null){
							?>
							<div class="text-danger text-monospace text-center">Ce commentaire n'existe pas !</div>
							<?php
						} else {
															
							?>
						
							<h2>{{$commentaire->titre}}</h2>
							
							<form method="POST" action="{{route('commentaire-modifier-post')}}">
								
								@csrf
														
								<div class="form-row pb-2 mt-4">
									<div class="col-2 text-secondary">titre <sup style="color:red">*</sup></div>
									<div class="col">
										<input id="titre" class="form-control @error('titre') is-invalid d-block @enderror" name="titre" type="text" value="{{ old('titre', $commentaire->titre) }}" autocomplete="titre" autofocus />
										@error('titre')
											<span class="invalid-feedback d-block" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>	

								<div class="form-row pb-2">
									<div class="col-2 text-secondary">
										<div>dossier <sup><i class="fas fa-info-circle" style="color:silver;" data-toggle="tooltip" data-placement="right" title="Laisser le champ vide pour placer l'enregistrement en dehors des dossiers."></i></sup></div>
									</div>
									<div class="col">

										<?php
										if (count($commentaires_dossiers) != 0){
											echo '<select class="custom-select" name="dossier">';
											echo '<option value="0"></option>';
											foreach($commentaires_dossiers as $commentaire_dossier){
												$selected = ($commentaire_dossier->id == $commentaire->dossier) ? 'selected' : '';
												echo '<option value="' . $commentaire_dossier->id . '"' . $selected . '>' . $commentaire_dossier->nom . '</option>';
											}
											echo '</select>';
										}
										?>

									</div>
								</div>	
								<div class="form-row">
									<div class="col-2"></div>
									<div class="col">
										<input type="hidden" name="commentaire_id" value="<?php echo $commentaire_id ?>">
										<button type="submit" class="btn btn-primary pl-4 pr-4"><i class="fas fa-check"></i></button>	
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