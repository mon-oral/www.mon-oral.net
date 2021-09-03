@include('inc-top')
<!doctype html>
<html lang="fr">
<head>
	@include('inc-meta')
	<title>Console | Entraînement</title>
</head>

<body>

	@include('inc-nav-console')

	<div class="container mb-5">
		<div class="row">

			<div class="col-md-2 pt-5">
				<a class="btn btn-light btn-sm" href="/console/entrainements" role="button"><i class="fas fa-arrow-left"></i></a>
				<div class="mt-5 text-left">
					<a class='btn btn-light btn-sm' href='/console/entrainement-modifier/{{ $entrainement_id }}' role='button'>modifier</a>
				</div>
			</div>

			<div class="col-md-10 pt-5">

				<?php
				$entrainement = App\Entrainement::where([['user_id', Auth::user()->id],['id', $entrainement_id]])->first();

				if ($entrainement === null){
					?>
					<div class="text-danger text-monospace text-center">cet entraînement n'existe pas !</div>
					<?php
				} else {
					?>

					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif

					<h1 class="mb-0">{{ $entrainement->titre }}</h1>
					<?php if ($entrainement->soustitre != '') echo '<p style="color:#84a9c7;font-style:italic;margin:-4px 0px 0px 0px;">' . $entrainement->soustitre . '</p>';?>
					<p class="mb-2 small text-monospace" style="color:#bdc3c7;margin-top:-4px;">{{ date("d-m-Y", strtotime($entrainement->created_at)) }}</p>


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
