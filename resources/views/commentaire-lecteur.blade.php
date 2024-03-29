@include('inc-top')
<!doctype html>
<html lang="fr">
<head>
	
	@include('inc-meta')

	<title>Capsule Audio</title>

	<!-- Open Graph -->
	<meta property="og:title" content="CAPSULE AUDIO" />
	<meta property="og:type" content="website" />
	<meta property="og:description" content="Pratique de l'oral au primaire et au secondaire - Préparation aux épreuves orales de collège et de lycée (brevet, français, langues, grand oral...)." />
	<meta property="og:url" content="https://www.mon-oral.net" />
	<meta property="og:image" content="{{ asset('img/opengraph_lecteur_1200x630.png') }}" />
	<meta property="og:image:alt" content="mon-oral.net" />
	<meta property="og:image:type" content="image/png" />
	<meta property="og:image:width" content="1200" />
	<meta property="og:image:height" content="630" />

	<!-- Twitter Card -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@mon_oral">
	<meta name="twitter:creator" content="@mon_oral">
	<meta name="twitter:title" content="CAPSULE AUDIO">
	<meta name="twitter:description" content="Pratique de l'oral au primaire et au secondaire - Préparation aux épreuves orales de collège et de lycée (brevet, français, langues, grand oral...).">
	<meta name="twitter:image" content="{{ asset('img/opengraph_lecteur_1200x630.png') }}">

</head>
<body>

	@include('inc-nav')

	<div class="container">

		<div class="row mt-4">

			<div class="col-md-8 offset-md-2">
			
				@if (Storage::exists('public/audio-commentaires/xektdgpmcw/@'.strtolower($code).'.mp3'))
					<table>
						<tr style="line-height:10px">
							<td style="width:100%">
								<audio controls style="width:100%"><source src="/s/{{strtolower($code)}}" type="audio/mpeg"></audio>
							</td>
							<td><a href="/telecharger-commentaire/{{$code}}" class="text-dark" style="verticla-align:middle;"><i class="fas fa-download ml-3 mr-3 text-muted" data-toggle="tooltip" data-placement="top" title="télécharger le fichier mp3"></i></a>
							</td>
						</tr>
						<tr>
							<td style="width:100%">
								<p class="mt-1 p-0 text-monospace text-center small" style="color:silver;">attendez quelques secondes que le lecteur se charge</p>
							</td>
							<td></td>
						</tr>
					</table>
				@else
					<p class="p-0 text-monospace text-center small" style="color:silver;">pas de fichier audio actuellement</p>
				@endif

				@auth
					@if (App\Commentaire::where([['user_id', Auth::id()],['code_audio',$code]])->exists())
						<div class="text-center mt-4">
							<a class="btn btn-success btn-sm" href="/console/commentaire-creer?a={{Crypt::encryptString(strtolower($code))}}" role="button"><i class="material-icons align-middle">&#xe31d</i></a>
							<p class="mt-1 p-0 text-monospace small" style="color:silver;">enregistrer / réenregistrer</p>
						</div>
					@endif
				@endauth

				<p class="text-center mt-4">
					<a class="btn btn-dark btn-sm" href="{{ url('/') }}" role="button"><i class="fas fa-times pr-2"></i>quitter</a>
				</p>

			</div>

		</div>

	</div><!-- /container -->

	@include('inc-bottom-js')

</body>
</html>
