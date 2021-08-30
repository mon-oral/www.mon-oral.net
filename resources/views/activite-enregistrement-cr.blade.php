@include('inc-top')
<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta')
	<title>Correction / commentaires / conseils</title>
	</head>
<body>

	@include('inc-nav')

    <?php
    $enregistrement_id = intval(base64_decode($code));
    $enregistrement = App\Activites_enregistrement::find($enregistrement_id);
    $activite = App\Activite::find($enregistrement->activite_id);
    ?>

	<div class="container">
		<div class="row mt-4">

			<div class="col-md-6 offset-md-1">
                <h2 class="text-center">COMMENTAIRES / CORRECTION / CONSEILS</h2>

                @if($enregistrement->cr_audio)
                    <table class="mt-4">
    					<tr style="line-height:10px">
    						<td style="width:100%">
    							<audio controls style="width:100%"><source src="/s/{{App\Commentaire::find($enregistrement->cr_audio)->code_audio}}" type="audio/mpeg"></audio>
    						</td>
    						<td><a style="display:block;font-size:120%;height:40px;line-height:40px;background-color:#f1f3f4;border-radius:4px;" href="/telecharger-commentaire/{{App\Commentaire::find($enregistrement->cr_audio)->code_audio}}" class="text-dark" style="verticla-align:middle;"><i class="fas fa-download ml-3 mr-3 text-muted" data-toggle="tooltip" data-placement="top" title="télécharger le fichier mp3"></i></a>
    						</td>
    					</tr>
    					<tr>
    						<td style="width:100%">
    							<p class="mt-1 p-0 text-monospace text-center small" style="color:silver;">attendez quelques secondes que le lecteur se charge</p>
    						</td>
    						<td></td>
    					</tr>
    				</table>
                @endif

                @if($enregistrement->cr_texte)
                    <div class="mt-4" style="background-color:#f1f3f4;border-radius:4px;padding:20px;">
                        <?php echo nl2br($enregistrement->cr_texte) ?>
                    </div>
                @endif

                <p class="text-center mt-5 mb-5">
                    <a class="btn btn-dark btn-sm" href="{{ url('/') }}" role="button"><i class="fas fa-times pr-2"></i>quitter</a>
                </p>

            </div>

            <div class="col-md-4 offset-md-1">

                <p class="text-center text-uppercase mb-0">{{ $activite->titre }}</p>
                <p class="text-center text-monospace mb-1" style="font-size:75%;color:silver;">{{ date("d-m-Y", strtotime($enregistrement->created_at)) }}</p>
                @if ($activite['consignes'] != '')
                    <?php
                    $consignes = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', strip_tags($activite->consignes));
                    $consignes = \Illuminate\Mail\Markdown::parse($consignes);
                    ?>
                    <div class="card">
                        <div class="card-body">
                            {{ $consignes }}
                        </div>
                    </div>
                @else
                     <div class="text-monospace small" style="color:silver">pas d'instructions / consignes pour cette activité</div>
                @endif

			</div>

		</div><!-- row -->
	</div><!-- /container -->

	@include('inc-bottom-js')

</body>
</html>
