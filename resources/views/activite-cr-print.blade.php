@include('inc-top')
<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta')
	<title>Activité - bilan</title>
	</head>
    <style>
    @media print {
        body * {
            visibility: hidden;
        }

        #print_content, #print_content * {
            visibility: visible;
        }

        #print_content {
            width:100vw !important;
        }

    }
    </style>
<body>

    @include('inc-nav-console')

    <?php
    $activite_id = Crypt::decryptString($activite_id);
    $activite = App\Activite::where([['user_id', Auth::user()->id],['id', $activite_id]])->first();

    if ($activite === null){
        ?>
        <div class="text-danger text-monospace text-center">Cette activité n'existe pas !</div>
        <?php
    } else {

        $enregistrements = App\Activites_enregistrement::where('activite_id',$activite_id)->orderBy('nom', 'asc')->orderBy('created_at', 'asc')->get();
        ?>

        <div class="container mb-5">
            <a class="btn btn-light btn-sm ml-3" href="/console/activite-afficher/{{ $activite_id }}" role="button"><i class="fas fa-arrow-left"></i></a>
            <h2 class="text-center">COMMENTAIRES / CORRECTION / CONSEILS</h2>
            <p class="text-center"><button class="btn btn-primary btn-sm" onclick="window.print();">imprimer</button></p>
        </div>

        {{-- PRINT --}}
        <div id="print_content" class="container">

            <p class="text-center mb-1" style="font-size:140%;">RÉCAPITULATIF</p>


            <p class="text-uppercase mt-3 mb-0">{{ $activite->titre }}</p>
            <p class="text-monospace mb-0" style="font-size:80%;color:silver;">{{ date("d-m-Y", strtotime($activite->created_at)) }}</p>
            <?php
            if ($activite['consignes'] != '') {
                $consignes = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', strip_tags($activite->consignes));
                $consignes = \Illuminate\Mail\Markdown::parse($consignes);
                ?>
                <div class="card"><div class="card-body"><?php echo $consignes ?></div></div>
                <?php
            } else {
                ?>
                <div class="card"><div class="card-body text-monospace small text-muted">pas d'instructions / consignes pour cette activité</div></div>
                <?php
            }
            ?>



            <table class="table table-bordered mt-2">
                <?php
                foreach ($enregistrements as $enregistrement) {
                    if ($enregistrement->cr_audio OR $enregistrement->cr_texte) {
                        ?>
                        <tr>
                            <td class="p-2"><h1><span class="badge badge-light text-monospace">{{ $enregistrement->nom }}</span></h1></td>
                            <td class="p-2" style="width:100%;vertical-align:top">{{ $enregistrement->cr_texte }}</td>
                            <td class="p-2 text-monospace small text-muted" nowrap><a href="{{ url('') }}/acr/{{ base64_encode(str_pad($enregistrement->id, 6, "0", STR_PAD_LEFT)) }}" target="_blank">{{ url('') }}/acr/{{ base64_encode(str_pad($enregistrement->id, 6, "0", STR_PAD_LEFT)) }}</a></td>
                            <td class="p-2"><img src="https://api.qrserver.com/v1/create-qr-code/?data={{ urlencode(url('').'/acr/' . base64_encode(str_pad($enregistrement->id, 6, "0", STR_PAD_LEFT))) }}&amp;size=60x60" /></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            <p class="text-monospace text-center mt-4 small text-muted">comptes rendus individuelles ci-dessous</p>

            <div style="page-break-after: always;">&nbsp;</div>

            <?php
            foreach ($enregistrements as $enregistrement) {
                if ($enregistrement->cr_audio OR $enregistrement->cr_texte) {
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <h1><span class="badge badge-light text-monospace">{{ $enregistrement->nom }}</span></h1>

                            <p class="text-uppercase mt-3 mb-0">{{ $activite->titre }}</p>
                            <p class="text-monospace mb-0" style="font-size:80%;color:silver;">{{ date("d-m-Y", strtotime($enregistrement->created_at)) }}</p>
                            <?php
                            if ($activite['consignes'] != '') {
                                $consignes = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', strip_tags($activite->consignes));
                                $consignes = \Illuminate\Mail\Markdown::parse($consignes);
                                ?>
                                <div class="card"><div class="card-body"><?php echo $consignes ?></div></div>
                                <?php
                            } else {
                                ?>
                                <div class="card"><div class="card-body text-monospace small text-muted">pas d'instructions / consignes pour cette activité</div></div>
                                <?php
                            }
                            ?>
                            <p class="text-monospace text-uppercase mt-4 mb-0">Commentaires / correction / conseils</p>
                            <div class="card">
                                <div class="card-body">
                                    <p id="correction_ecrit_texte_{{$enregistrement->id }}_print">{{ $enregistrement->cr_texte }}</p>
                                </div>
                            </div>
                            @if ($enregistrement->cr_audio)
                            <p>Ecouter : <span class="text-monospace">{{ url('') }}/acr/{{ base64_encode(str_pad($enregistrement->id, 6, "0", STR_PAD_LEFT)) }}</span></p>
                            @endif

                            <div class="text-center mt-2">
                                <div>- consuter en ligne -</div>
                                <div class="text-monospace text-muted"><a href="{{ url('') }}/acr/{{ base64_encode(str_pad($enregistrement->id, 6, "0", STR_PAD_LEFT)) }}" target="_blank">{{ url('') }}/acr/{{ base64_encode(str_pad($enregistrement->id, 6, "0", STR_PAD_LEFT)) }}</a></div>
                                <div class="p-2"><img src="https://api.qrserver.com/v1/create-qr-code/?data={{ urlencode(url('').'/acr/' . base64_encode(str_pad($enregistrement->id, 6, "0", STR_PAD_LEFT))) }}&amp;size=100x100" /></div>
                            </div>
                        </div>
                    </div>
                    <div style="page-break-after: always;">&nbsp;</div>
                    <?php
                }
            }
            ?>
        </div>
        {{-- /PRINT --}}

        <?php
    }
    ?>

	@include('inc-bottom-js')

</body>
</html>
