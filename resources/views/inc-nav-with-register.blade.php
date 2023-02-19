<nav class="navbar navbar-expand-md navbar-light">
    <div class="container">
        <div>
            <div><a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.svg') }}" width="60" /></a></div>
            <div class="text-monospace" style="font-size:65%;color:silver;">mon-oral.net</div>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto" style="padding-left:100px;">
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item"><a class="btn btn-outline-secondary btn-sm" style="font-size:80%;opacity:0.4;margin:2px 0px 0px 4px" href="{{ url('/console') }}">console</a></li>
                    @else
                        <li class="nav-item" style="font-size:80%;opacity:0.3;padding:6px 0px 0px 4px">Enseignants :</li>
                        <li class="nav-item"><a class="btn btn-outline-secondary btn-sm" style="font-size:80%;opacity:0.4;margin:2px 0px 0px 4px" href="{{ route('login') }}">se connecter</a></li>
                        @if (Route::has('register-intro'))
                            <li class="nav-item"><a class="btn btn-outline-secondary btn-sm " style="font-size:80%;opacity:0.4;margin:2px 0px 0px 4px" href="{{ route('register-intro') }}">créer un compte</a></li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>
