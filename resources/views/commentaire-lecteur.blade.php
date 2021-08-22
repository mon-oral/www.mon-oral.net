<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')
		
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />

		<title>Capsule audio</title>
		
	</head>
		
	<body>	
		
		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><img src="{{ asset('img/mon-oral.png') }}" width="40" /></div>
						<div class="text-monospace small" style="color:#c5c7c9;margin-top:4px;">capsule audio</div>
					</div>
				</div>
			</nav>		
		
			<div class="container">
									
				<div class="row mt-4">
				
					<div class="col-md-8 offset-md-2">
			
						<table>
							<tr style="line-height:10px">
								<td style="font-size:150%;"><i class="fas fa-volume-up mr-4 text-dark"></i></td>
								<td style="width:100%">
									<audio controls style="width:100%"><source src="/s/{{$code}}" type="audio/mpeg"></audio>
								</td>
								<td><a style="display:block;font-size:120%;height:40px;line-height:40px;background-color:#f1f3f4;border-radius:4px;" href="/telecharger-commentaire/{{$code}}" class="text-dark" style="verticla-align:middle;"><i class="fas fa-download ml-3 mr-3 text-muted" data-toggle="tooltip" data-placement="top" title="télécharger le fichier mp3"></i></a>
								</td>
							</tr>	
							<tr>
								<td></td>
								<td style="width:100%">
									<p class="mt-1 p-0 text-monospace text-center small" style="color:silver;">attendez quelques secondes que le lecteur se charge</p>
								</td>
								<td></td>
							</tr>								
						</table>
						
						<p class="text-center mt-4">
							<a class="btn btn-dark btn-sm" href="{{ url('/') }}" role="button"><i class="fas fa-times pr-2"></i>quitter</a>
						</p>

					</div>

				</div>
		
			</div><!-- /container -->
			
		</div><!-- /app -->
		
		@include('inc-bottom-js')	
		
	</body>
</html>