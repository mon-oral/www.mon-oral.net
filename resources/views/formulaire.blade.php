<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')

		<title>Formulaire</title>
		
	</head>
		
	<body>	
		
		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.png') }}" width="40" /></a></div>
						<div class="text-monospace small" style="color:#c5c7c9;margin-top:-2px;">formulaire</div>
					</div>
				</div>
			</nav>

			<div class="container mb-5">

				<div class="row">
				
					<div class="col-md-2 pt-5">
						@if (Auth::check())
							<a class="btn btn-light btn-sm" href="console" role="button"><i class="fas fa-arrow-left"></i></a>
						@else
							<a class="btn btn-light btn-sm" href="/" role="button"><i class="fas fa-arrow-left"></i></a>
						@endif
					</div>					
					
					<div class="col-md-10 pt-5">
					
						@if(session()->has('formulaire_status'))
							 <p class="text-center text-monospace text-success">{{session('formulaire_status')}}</p>
						@else
						
							<h1>Écrivez-nous</h1>
								
							<form method="POST" action="{{route('formulaire-post')}}">
								
								@csrf
															
								<div class="form-row mt-4">
									<div class="col-3 text-secondary">titre <sup style="color:red">*</sup></div>
									<div class="col">
										<input id="titre" class="form-control @error('titre') is-invalid d-block @enderror" name="titre" type="text" value="{{ old('titre') }}" autocomplete="titre" autofocus />
										@error('titre')
											<span class="invalid-feedback d-block" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>	
								
								<div class="form-row mt-4">
									<div class="col-3 text-secondary">
										<div>votre adresse courriel</div>
										<div class="small" style="color:#c5c7c9;font-style:italic;margin-top:-5px;">optionnel</div>
									</div>
									<div class="col">
										<input id="adresse" class="form-control @error('adresse') is-invalid d-block @enderror" name="adresse" type="text" value="{{ old('adresse') }}" autocomplete="adresse" autofocus />
										@error('adresse')
											<span class="invalid-feedback d-block" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>								
								
								<div class="form-row mt-4">
									<div class="col-3 text-secondary">
										<div>message <sup style="color:red">*</sup></div>
									</div>
									<div class="col">
										<textarea class="form-control @error('message') is-invalid d-block @enderror" id="message" name="message" rows="6">{{ old('message') }}</textarea>
										@error('message')
											<span class="invalid-feedback d-block" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror	
										
										<button type="submit" class="btn btn-primary mt-3 pl-4 pr-4"><i class="fas fa-paper-plane"></i></button>
									</div>
									
									

								</div>	
								
								

							</form>	
						@endif
					</div>
				</div>
				
			</div><!-- /container -->
			
		</div><!-- /app -->
	
		@include('inc-bottom')
		@include('inc-bottom-js')
	
	</body>
</html>