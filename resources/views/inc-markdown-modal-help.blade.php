<!-- MODAL MARKDOWN HELP -->
<div class="modal fade" id="markdown_help" tabindex="-1" aria-labelledby="markdown_helpLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <b class="modal-title" id="exampleModalLabel">Formatage du texte</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-hover small">
                    <tr>
                        <td></td>
                        <td class="p-2 text-center">SYNTAXE</td>
                        <td class="p-2 text-center">RENDU</td>
                    </tr>
                    <tr>
                        <td class="p-2">PARAGRAPHES</td>
                        <td class="p-2 text-monospace text-muted">paragraphe<br /><br />paragraphe<p class="mt-2 mb-0" style="color:silver">Laisser une ligne vide pour marquer un nouveau paragraphe.</p></td>
                        <td class="p-2" style="vertical-align:top"><p class="mb-1">paragraphe</p>paragraphe</td>
                    </tr>
                    <tr>
                        <td class="p-2">RETOUR À LA LIGNE</td>
                        <td class="p-2 text-monospace text-muted">ligne \<br />ligne<p class="mt-2 mb-0" style="color:silver">Ajouter un \ en bout de ligne pour forcer le retour à la ligne.</p></td>
                        <td class="p-2" style="vertical-align:top">ligne<br />ligne</td>
                    </tr>
                    <tr>
                        <td class="p-2">LISTES</td>
                        <td class="p-2 text-monospace text-muted">* point 1<br />* point 2<br /></td>
                        <td class="p-2" style="vertical-align:top"><ul style="padding-left:20px;margin-left:0;margin-bottom:0"><li>point 1</li><li>point 2</li></ul></td>
                    </tr>
                    <tr>
                        <td class="p-2">ITALIQUE</td>
                        <td class="p-2 text-monospace text-muted">*italique*</td>
                        <td class="p-2"><em>italique</em></td>
                    </tr>
                    <tr>
                        <td class="p-2">GRAS</td>
                        <td class="p-2 text-monospace text-muted">**gras**</td>
                        <td class="p-2"><b>gras</b></td>
                    </tr>
                    <tr>
                        <td class="p-2">SOULIGNÉ</td>
                        <td class="p-2 text-monospace text-muted">__souligné__</td>
                        <td class="p-2"><u>souligné</u></td>
                    </tr>
                    <tr>
                        <td class="p-2">IMAGE</td>
                        <td class="p-2 text-monospace text-muted">
                            <p>![](url-image)</p>
                            <p class="mb-0"><i>Exemple : ![](https://www.mon-oral.net/img/mon-oral.png)<i></p>
                        </td>
                        <td class="p-2"><img src="https://www.mon-oral.net/img/mon-oral.png" width="60"/></td>
                    </tr>
                    <tr>
                        <td class="p-2">LIEN</td>
                        <td class="p-2 text-monospace text-muted">
                            <p>[texte-cliquable](url-site)</p>
                            <p class="mb-1"><i>Exemple 1 : Un [lien](https://eduscol.education.fr) vers Eduscol.</i></p>
                            <p class="mb-0"><i>Exemple 2 : Un lien vers [Eduscol](https://eduscol.education.fr).</i></p>
                        </td>
                        <td class="p-2">
                            <p class="mb-0">&nbsp;</p>
                            <p class="mb-1">Un <a href="https://eduscol.education.fr">lien</a> vers Eduscol.</p>
                            <p class="mb-0">Un lien vers <a href="https://eduscol.education.fr">Eduscol</a>.</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2">LATEX</td>
                        <td class="p-2 text-monospace text-muted">
                            <p class="mb-0"><i>Présentation en ligne</i></p>
                            <p>Soit \$e^x = \sum_{k=0}^{\infty} \frac{x^k}{k!}\$</p>
                            <p class="mb-0"><i>Présentation en bloc (centré)</i></p>
                            <p>\$\$f'(a) = \lim_{x \to a} \frac{f(x) - f(a)}{x - a}\$\$</p>
                            <p class="mt-2">Voir <a href="https://mon-oral.github.io/documentation/Syntaxe%20LaTex/" target="_blank">documentation</a></p>
                        </td>
                        <td class="p-2">
                            <p class="mb-0">&nbsp;</p>
                            <p class="mb-0">Soit&nbsp;&nbsp;$e^x = \sum_{k=0}^{\infty} \frac{x^k}{k!}$</p>
                            <p class="mb-0">&nbsp;</p>
                            <p class="mb-0">$$f'(a) = \lim_{x \to a} \frac{f(x) - f(a)}{x - a}$$</p>
                            <p class="mt-2">&nbsp;</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- MODAL MARKDOWN HELP -->
