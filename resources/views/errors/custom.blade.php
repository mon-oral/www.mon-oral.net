@include('inc-top')
<!doctype html>
<html lang="fr">
<head>
	@include('inc-meta')
	<title>oups</title>
</head>
    <body>
        <div class="container">
            <div class="row mt-5">
                <div class="col text-center"><img src="{{ url('/')}}/img/mon-oral.svg" width="200" /></div>
            </div>
            <div class="row mt-3">
                <div class="col text-center text-uppercase" style="font-size:150%;color:#a0aec0">@yield('code') | @yield('message')</div>
            </div>
            <div class="row mt-5">
                <div class="col text-center text-monospace small" style="color:silver">vous pouvez signaler ce problème <a href="https://github.com/mon-oral/www.mon-oral.net/issues/new/choose" target="_blank">ici</a> ou écrire à : contact@mon-oral.net</div>
            </div>
            <div class="row mt-4">
                <div class="col text-center small" style="opacity:0.6"><a class="btn btn-outline-secondary btn-sm" href="/" role="button">retour sur le page d'accueil</a></div>
            </div>
        </div>
    </body>
</html>
