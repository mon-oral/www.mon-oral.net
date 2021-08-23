@include('inc-top')
<!doctype html>
<html lang="fr">
<head>
	@include('inc-meta')
	<title>Inscription - enseignant ou élève ?</title>
</head>
<body>

    @include('inc-nav')

    <div class="container mb-5">

        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="text-center mb-4">INSCRIPTION</h1>
            </div>
        </div><!-- /row -->

        <div class="row">
            <div class="col-md-3 offset-md-3 text-center">
                <div class="card-deck">
                    <div class="card">
                        <div class="text-center pt-4"><img src="{{ asset('img/enseignant.png') }}" width="140" alt="enseignant" /></div>
                        <div class="card-body pt-0">
                            <h2 class="text-center">ENSEIGNANT</h2>
                            <div class="text-center mt-2"><a class="btn btn-primary btn-sm" href="/inscription" role="button"><i class="fas fa-check pl-2 pr-2"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="card-deck">
                    <div class="card">
                        <div class="text-center pt-4"><img src="{{ asset('img/eleve.png') }}" width="140" alt="élève" /></div>
                        <div class="card-body pt-0">
                            <h2 class="text-center">ÉLÈVE</h2>
                            <div class="text-center"><a class="btn btn-primary btn-sm" href="#" role="button" data-container="body" data-placement="top" data-toggle="popover" data-placement="top" data-html="true" data-content="<div class='text-justify p-3'><p class='text-center text-danger text-monospace'>LES ÉLÈVES NE DOIVENT PAS CRÉER DE COMPTE</p>Si vous êtes un élève, votre enseignant a dû vous donner un lien direct ou un code. Suivez ce lien ou saisissez votre code dans l'espace '<a href='entrainement'>ENTRAÎNEMENTS</a>' ou '<a href='entrainement'>ACTIVITÉS</a>'.</div>"><i class="fas fa-check pl-2 pr-2"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /row -->

    </div><!-- /container -->

    @include('inc-footer')
    @include('inc-bottom-js')

</body>
</html>
