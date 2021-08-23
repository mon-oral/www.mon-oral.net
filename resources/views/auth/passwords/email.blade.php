@include('inc-top')
<!doctype html>
<html lang="fr">
<head>
	@include('inc-meta')
	<title>Réinitialisation du mot de passe</title>
</head>
<body>

    @include('inc-nav')

    <div class="container mb-5">
        <div class="row">

            <div class="col-md-10 offset-md-2">

                <h1>Réinitialisation du mot de passe</h1>
                <p class="text-monospace text-muted small">Un lien de réinitialisation sera envoyé à l'adresse indiquée.</p>

                <div class="card-body">
                    @if (session('status'))
                        <div class="text-success text-monospace text-center pb-4" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">Adresse courriel</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-2">
                                <button type="submit" class="btn btn-primary pl-4 pr-4"><i class="fas fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div><!-- /row -->
    </div><!-- /container -->

</body>
</html>
