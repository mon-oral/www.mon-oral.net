@include('inc-top')
<!doctype html>
<html lang="fr">
<head>
	@include('inc-meta')
	<title>Inscription</title>
</head>
<body>

    @include('inc-nav')

    <div class="container mb-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">

                    <h1>INSCRIPTION</h1>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register_post') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="prenom" class="col-md-4 col-form-label text-md-right">Prénom<sup class="text-danger"> *</sup></label>

                                <div class="col-md-6">
                                    <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') }}" required autocomplete="prenom" autofocus>

                                    @error('prenom')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nom" class="col-md-4 col-form-label text-md-right">Nom<sup class="text-danger"> *</sup></label>

                                <div class="col-md-6">
                                    <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required autocomplete="nom" autofocus>

                                    @error('nom')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="etablissement" class="col-md-4 col-form-label text-md-right">Établissement<sup class="text-danger"> *</sup></label>

                                <div class="col-md-6">
                                    <input id="etablissement" type="text" class="form-control @error('etablissement') is-invalid @enderror" name="etablissement" value="{{ old('etablissement') }}" required autocomplete="etablissement">

                                    @error('etablissement')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="etablissement_type" class="col-md-4 col-form-label text-md-right">Type d'établissement<sup class="text-danger"> *</sup></label>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <select name="etablissement_type" class="custom-select @error('etablissement_type') is-invalid @enderror">
                                            <option></option>
                                            <option value="public">public</option>
                                            <option value="private">privé</option>
                                        </select>
                                    </div>

                                    @error('etablissement_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                            

                            <div class="form-group row">
                                <label for="matiere" class="col-md-4 col-form-label text-md-right">Matière enseignée<sup class="text-danger"> *</sup></label>

                                <div class="col-md-6">
                                    <input id="matiere" type="text" class="form-control @error('matiere') is-invalid @enderror" name="matiere" value="{{ old('matiere') }}" required autocomplete="matiere">

                                    @error('matiere')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right"style="line-height: 1">Adresse email professionnelle<sup class="text-danger"> *</sup><br /><span class="small text-danger">adresse académique ou adresse de l'établissement</span></label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-4">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe<sup class="text-danger"> *</sup></label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmation du mot de passe<sup class="text-danger"> *</sup></label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

    						<div class="form-group row pt-3">
    							<label for="password-confirm" class="col-md-4 text-right"><span class="badge badge-warning small">RGPD</span></label>

    							<div class="col-md-6">
    								<div class="form-check">
    									<input class="form-check-input" style="cursor:pointer" type="checkbox"  onchange="document.getElementById('inscription').disabled = !this.checked;" value="" id="defaultCheck1">
    									<label class="form-check-label text-monospace small text-justify pr-1" style="padding-top:2px;" for="defaultCheck1">J’autorise ce site à conserver les données transmises via ce formulaire. Ces données peuvent être supprimées à tout moment en sélectionnant "supprimer ce compte" dans l'espace enseignant.</label>
    								</div>
    							</div>
    						</div>

                            <div class="form-group row mb-0 pt-2">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="inscription" class="btn btn-primary pl-4 pr-4" disabled><i class="fas fa-check"></i></button>
                                </div>
                            </div>

                        </form>
                    </div>

            </div>
        </div><!-- /row -->
    </div><!-- /container -->

</body>
</html>
