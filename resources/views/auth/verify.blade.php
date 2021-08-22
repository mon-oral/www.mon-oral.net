@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5 text-muted" style="background:none;border:none;">
                <p><b>Consultez votre boîte aux lettres</b></p>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    Vous allez recevoir dans quelques minutes un courriel de vérification. Ouvrez-le puis cliquez sur le lien pour valider votre inscription.
                    Si vous ne l'avez pas reçu,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">cliquez ici pour le renvoyer</button>.
                    </form>
					<br />
					<br />
					En cas de problème, vous pouvez écrire à <a href="mailto:contact@mon-oral.net">contact@mon-oral.net</a> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
