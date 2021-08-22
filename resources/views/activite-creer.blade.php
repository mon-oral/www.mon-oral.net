@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')

		<title>Console | Nouvelle activité</title>
		
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

			<?php
			$user = Auth::user();
			?>
			
			<!-- MODAL MARKDOWN HELP -->
			<div class="modal fade" id="markdown_help" tabindex="-1" aria-labelledby="markdown_helpLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<b class="modal-title" id="exampleModalLabel">Formatage du texte</b>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<table class="table table-bordered table-hover small">
								<tr>
									<td></td>
									<td class="p-2 text-center">SYNTAXE</td>
									<td class="p-2 text-center">RENDU</td>
								</tr>
								<tr>
									<td class="p-2">PARAGRAPHES</td>
									<td class="p-2 text-monospace text-muted">paragraphe<br /><br />paragraphe<p class="mt-2 mb-0" style="color:silver">Laisser une ligne vide pour marquer un nouveau paragraphe.</p></td>
									<td class="p-2" style="vertical-align:top"><p class="mb-1">paragraphe</p>paragraphe</td>
								</tr>	
								<tr>
									<td class="p-2">RETOUR Á LA LIGNE</td>
									<td class="p-2 text-monospace text-muted">ligne \<br />ligne<p class="mt-2 mb-0" style="color:silver">Ajouter un \ en bout de ligne pour forcer le retour à la ligne.</p></td>
									<td class="p-2" style="vertical-align:top">ligne<br />ligne</td>
								</tr>
								<tr>
									<td class="p-2">LISTES</td>
									<td class="p-2 text-monospace text-muted">* point 1<br />* point 2<br /></td>
									<td class="p-2" style="vertical-align:top"><ul style="padding-left:20px;margin-left:0;margin-bottom:0"><li>point 1</li><li>point 2</li></ul></td>
								</tr>									
								<tr>
									<td class="p-2">ITALIQUE</td>
									<td class="p-2 text-monospace text-muted">*italique*</td>
									<td class="p-2"><em>italique</em></td>
								</tr>
								<tr>
									<td class="p-2">GRAS</td>
									<td class="p-2 text-monospace text-muted">**gras**</td>
									<td class="p-2"><b>gras</b></td>
								</tr>
								<tr>
									<td class="p-2">SOULIGNÉ</td>
									<td class="p-2 text-monospace text-muted">__souligné__</td>
									<td class="p-2"><u>souligné</u></td>
								</tr>
								<tr>
									<td class="p-2">IMAGE</td>
									<td class="p-2 text-monospace text-muted">
										<p>![](url-image)</p>
										<p class="mb-0"><i>Exemple : ![](https://www.mon-oral.net/img/mon-oral.png)<i></p>
									</td>
									<td class="p-2"><img src="https://www.mon-oral.net/img/mon-oral.png" width="60"/></td>
								</tr>							
								<tr>
									<td class="p-2">LIEN</td>
									<td class="p-2 text-monospace text-muted">
										<p>[texte-cliquable](url-site)</p>
										<p class="mb-1"><i>Exemple 1 : Un [lien](https://eduscol.education.fr) vers Eduscol.</i></p>
										<p class="mb-0"><i>Exemple 2 : Un lien vers [Eduscol](https://eduscol.education.fr).</i></p>
									</td>
									<td class="p-2">
										<p><br /></p>
										<p class="mb-1">Un <a href="https://eduscol.education.fr">lien</a> vers Eduscol.</p>
										<p class="mb-0">Un lien vers <a href="https://eduscol.education.fr">Eduscol</a>.</p>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>	
			<!-- MODAL MARKDOWN HELP -->			

			<div class="container mb-5">

				<div class="row">
				
					<div class="col-md-2 pt-5">
						<a class="btn btn-light btn-sm" href="/console" role="button"><i class="fas fa-arrow-left"></i></a>
					</div>					
					
					<div class="col-md-10 pt-5">

						@if (session('status'))
							<div class="text-success text-monospace text-center pb-4" role="alert">
								{{ session('status') }}
							</div>
						@endif		
							
						<h1>Nouvelle activité</h1>
						<!--<h1 style="color:red;font-size:200%">EN TRAVAUX PENDANT UNE HEURE - NE PAS UTILISER CETTE PAGE</h1>-->
							
						<form method="POST" action="{{route('activite-creer-post')}}">
							
							@csrf
														
							<div class="form-row pb-3 mt-4">
								<div class="col-2 text-secondary">titre <sup style="color:red">*</sup></div>
								<div class="col">
									<input id="titre" class="form-control @error('titre') is-invalid d-block @enderror" name="titre" type="text" value="{{ old('titre') }}" autocomplete="titre" autofocus />
									@error('titre')
										<span class="invalid-feedback d-block" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
									<small class="form-text text-muted">visible seulement par les enseignants dans la console.</small>
								</div>
							</div>	
												
							<div class="form-row pb-3">
								<div class="col-2 text-secondary">
									<div>sous-titre</div>
									<div class="small" style="color:#c5c7c9;font-style:italic;margin-top:-5px;">optionnel</div>
								</div>
								<div class="col">
									<input id="soustitre" class="form-control @error('soustitre') is-invalid d-block @enderror" name="soustitre" type="text" value="{{ old('soustitre') }}" autocomplete="soustitre" autofocus />
									@error('soustitre')
										<span class="invalid-feedback d-block" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror	
									<small class="form-text text-muted">visible par les élèves - exemples : "Exercice de lecture", "Récitation", "Podcast", "Emission webradio"...</small>
								</div>
							</div>										
							
							<div class="form-row pb-3">
								<div class="col-3 text-secondary">
									<div>sujet / consignes<i class="fas fa-info-circle pl-2" style="cursor:pointer" data-toggle="modal" data-target="#markdown_help""></i></div>
									<div class="small" style="color:#c5c7c9;font-style:italic;margin-top:-5px;">optionnel</div>
								</div>
								<div class="col">
									<textarea class="form-control @error('consignes') is-invalid d-block @enderror" id="consignes" name="consignes" rows="8">{{ old('consignes') }}</textarea>
									@error('consignes')
										<span class="invalid-feedback d-block" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror	
								</div>

							</div>	
							
							<input type="hidden" name="user_id" value="{{ $user->id }}">
							
							<button type="submit" class="btn btn-primary mt-2 pl-4 pr-4"><i class="fas fa-check"></i></button>

						</form>	

					</div>
				</div>
				
			</div><!-- /container -->
			
		</div><!-- /app -->
	
		@include('inc-bottom')
		@include('inc-bottom-js')
		
	</body>
</html>