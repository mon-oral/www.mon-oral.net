<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// AUTH ROUTES
Auth::routes(['verify' => true]);

// Home
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Bac à  sable
Route::get('/bac-a-sable', function () {
    return view('bac-a-sable');
});

// Discussions
Route::get('/discussions', function () {
    return view('discussions');
})->middleware('auth');;

// Webinaire
Route::get('/webinaire', function () {
    return view('webinaire');
});

// Présentation
Route::get('/presentation', function () {
    return view('presentation');
})->name('presentation');

// Données personnelles
Route::get('/donnees-personnelles', function () {
    return view('donnees-personnelles');
})->name('donnees-personnelles');

Route::any('/admin', 'AdminController@admin');
Route::any('/stats', 'AdminController@stats');


Route::get('telecharger-capsule/{filename}', function ($filename) {
    return Storage::disk('local')->download('/public/audio-capsules/sfokasnejd/'.$filename.'.mp3');
});

Route::get('telecharger-entrainement/{filename}', function ($filename) {
    return Storage::disk('local')->download('/public/audio-entrainements/lrpxmensjw/'.$filename.'.mp3');
});

Route::get('telecharger-activite/{filename}', function ($filename) {
    return Storage::disk('local')->download('/public/audio-activites/glensaeqmd/@'.$filename.'.mp3');
});

Route::get('telecharger-commentaire/{filename}', function ($filename) {
    return Storage::disk('local')->download('/public/audio-commentaires/xektdgpmcw/@'.$filename.'.mp3');
});





// ============================================================================
// == CAPSULES ELEVES
// ============================================================================

// capsule-enregistrement
Route::any('/capsule', 'CapsuleController@enregistrement')->name('capsule-enregistrement');

// capsule-telechargement
Route::any('/capsule-telechargement', 'CapsuleController@telechargement')->name('capsule-telechargement');

// capsule-mp3
Route::post('/capsule-mp3', 'CapsuleController@mp3');
Route::get('/capsule-mp3', 'CapsuleController@redirect');

// capsule-lecteur
Route::any('/capsule-lecteur', 'CapsuleController@lecteur')->name('capsule-lecteur');

// capsule-quitter (suppression de l'enregistrement)
Route::any('/capsule-quitter', 'CapsuleController@quitter')->name('capsule-quitter');

// capsule-refaire (suppression de l'enregistrement pour nouvel enregistrement)
Route::get('/capsule-refaire', 'CapsuleController@refaire')->name('capsule-refaire');

// ============================================================================
// == COMMENTAIRES
// ============================================================================

// commentaires-liste
Route::any('/console/commentaires', 'ConsoleController@commentaires_liste')->name('commentaires-liste');

// commentaire-creer
//Route::get('/console/commentaire-creer', 'CommentaireController@commentaire_creer_get')->name('commentaire-creer-get');
//Route::post('/console/commentaire-creer', 'CommentaireController@commentaire_creer_post')->name('commentaire-creer-post');

// commentaire-creer
Route::any('/console/commentaire-creer', 'CommentaireController@creer')->name('commentaire-creer');

// commentaire-creer2
Route::any('/console/commentaire-creer2', 'CommentaireController@creer2')->name('commentaire-creer2');

// commentaires-dossier-creer
Route::get('/console/commentaires/dossier-creer', 'CommentaireController@dossier_creer')->name('commentaires-dossier-creer');
Route::post('/console/commentaires/dossier-creer', 'CommentaireController@dossier_creer_post')->name('commentaires-dossier-creer-post');

// commentaires-dossier-modifier
Route::get('/console/commentaires/dossier-modifier/{dossier_id}', 'CommentaireController@commentaires_dossier_modifier')->name('commentaires-dossier-modifier');
Route::get('/console/commentaires/dossier-modifier', 'CommentaireController@redirect');
Route::post('/console/commentaires/dossier-modifier', 'CommentaireController@commentaires_dossier_modifier_post')->name('commentaires-dossier-modifier-post');

// commentaires-dossier-liste
Route::any('/console/commentaires/dossier/{dossier_id}', 'ConsoleController@commentaires_dossier_liste')->name('commentaires-dossier-liste');

// commentaire-verifier
Route::get('/console/commentaire-verifier', 'CommentaireController@verifier')->name('commentaire-verifier');


// commentaire-verifier-ecoute
Route::get('/console/commentaire-verifier-ecoute', 'CommentaireController@verifier_ecoute')->name('commentaire-verifier-ecoute');

// commentaire-sauvegarder
Route::get('/console/commentaire-sauvegarder', 'CommentaireController@redirect')->name('commentaire-sauvegarder');
Route::post('/console/commentaire-sauvegarder', 'CommentaireController@sauvegarder_post')->name('commentaire-sauvegarder-post');


// commentaire-sauvegarder-ecoute
Route::any('/console/commentaire-sauvegarder-ecoute', 'CommentaireController@sauvegarder_ecoute')->name('commentaire-sauvegarder-ecoute');

// commentaire-lecteur
Route::get('/c/{code}', function($code) {
    return view("commentaire-lecteur", ["code"=>$code]);
})->name('commentaire-lecteur');

// commentaire-lecteur-ecoute
Route::get('/s/{code}', 'SiteController@commentaire_lecteur_ecoute')->name('commentaire-lecteur-ecoute');

// commentaire-mp3
Route::post('/console/commentaire-mp3', 'CommentaireController@mp3');
Route::get('/console/commentaire-mp3', 'CommentaireController@redirect');
Route::get('/commentaire-mp3', 'CommentaireController@redirect');

// commentaire-quitter (suppression de l'enregistrement)
Route::get('/console/commentaire-quitter', 'CommentaireController@quitter')->name('commentaire-quitter');

// commentaire-refaire (suppression de l'enregistrement pour nouvel enregistrement)
Route::get('/console/commentaire-refaire', 'CommentaireController@refaire')->name('commentaire-refaire');

// commentaire-modifier
Route::get('/console/commentaire-modifier/{commentaire_id}', 'CommentaireController@commentaire_modifier')->name('commentaire-modifier');
Route::get('/console/commentaire-modifier', 'CommentaireController@redirect');
Route::post('/console/commentaire-modifier', 'CommentaireController@commentaire_modifier_post')->name('commentaire-modifier-post');

// commentaire-supprimer
Route::get('/console/commentaire-supprimer/{commentaire_id}', 'CommentaireController@commentaire_supprimer')->name('commentaire-supprimer');
Route::get('/console/commentaire-supprimer', 'CommentaireController@redirect');

// commentaires-dossier-supprimer
Route::get('/console/commentaires/dossier-supprimer/{dossier_id}', 'CommentaireController@commentaires_dossier_supprimer')->name('commentaires-dossier-supprimer');
Route::get('/console/commentaires/dossier-supprimer', 'CommentaireController@redirect');


// ============================================================================
// == GRAND ORAL
// ============================================================================

// grandoral-creer
Route::get('/console/grandoral-creer', 'ConsoleController@grandoral_creer_get')->name('grandoral-creer-get');
Route::post('/console/grandoral-creer', 'ConsoleController@grandoral_creer_post')->name('grandoral-creer-post');

// grandoral-modifier
Route::get('/console/grandoral-modifier/{grandoral_id}', 'ConsoleController@grandoral_modifier_get')->name('grandoral-modifier-get');
Route::get('/console/grandoral-modifier', 'ConsoleController@redirect');
Route::post('/console/grandoral-modifier', 'ConsoleController@grandoral_modifier_post')->name('grandoral-modifier-post');


// grandoral-etape1 - prenom, nom, code
Route::get('/grandoral', 'GrandoralController@etape1')->name('grandoral-etape1');
//Route::post('/grandoral', 'GrandoralController@etape1Post');


// ============================================================================
// == VALIDATION COMPTES
// ============================================================================

// accepter
Route::get('/admin/compte_accepter/{user_id}', 'AdminController@compte_accepter');

// refuser
Route::get('/admin/compte_refuser/{user_id}', 'AdminController@compte_refuser');

// ============================================================================
// == FORMULAIRE
// ============================================================================
Route::get('/formulaire_contact', 'SiteController@formulaire_get')->name('formulaire-get');
Route::post('/formulaire_contact', 'SiteController@formulaire_post')->name('formulaire-post');


// ============================================================================
// == ACTIVITES - CONSOLE
// ============================================================================

// activites-liste
Route::any('/console/activites', 'ConsoleController@activites_liste')->name('activites-liste');

// activite-creer
Route::get('/console/activite-creer', 'ConsoleController@activite_creer_get')->name('activite-creer');
Route::post('/console/activite-creer', 'ConsoleController@activite_creer_post')->name('activite-creer-post');

// activite-modifier
Route::get('/console/activite-modifier/{entrainement_id}', 'ConsoleController@activite_modifier_get')->name('activite-modifier-get');
Route::get('/console/activite-modifier', 'ConsoleController@redirect');
Route::post('/console/activite-modifier', 'ConsoleController@activite_modifier_post')->name('activite-modifier-post');

// activite-afficher
Route::any('/console/activite-afficher/{activite_id}', 'ConsoleController@activite_afficher_any')->name('activite-afficher-any');
Route::any('/console/activite-afficher', 'ConsoleController@redirect');

// activite-correction-creer
Route::get('/console/activite-correction-creer', 'ConsoleController@redirect');
Route::post('/console/activite-correction-creer', 'ConsoleController@activite_correction_creer_post')->name('activite-correction-creer-post');

// activite-correction-supprimer
Route::get('/console/activite-correction-supprimer/{correction_id}', 'ConsoleController@activite_correction_supprimer')->name('activite-correction-supprimer');
Route::get('/console/activite-correction-supprimer', 'CommentaireController@redirect');


// ============================================================================
// == ACTIVITES - ELEVES
// ============================================================================

// activite-identifier
Route::get('/activite', 'ActiviteController@identifier_get')->name('activite-etape-identifier-get');
Route::get('/a/{code}', function($code){
	return view('activite-etape-identifier')->with('code', $code);
});
Route::post('/a/{code}', 'ActiviteController@identifier_post');
Route::post('/activite', 'ActiviteController@identifier_post');

// activite-enregistrer
Route::any('/activite-etape-enregistrer', 'ActiviteController@enregistrer')->name('activite-etape-enregistrer');

// activite-verifier
Route::any('/activite-etape-verifier', 'ActiviteController@verifier')->name('activite-etape-verifier');

// activite-verifier-ecoute
Route::any('/activite-etape-verifier-ecoute', 'ActiviteController@verifier_ecoute')->name('activite-etape-verifier-ecoute');

// activite-sauvegarder
Route::any('/activite-etape-sauvegarder', 'ActiviteController@sauvegarder')->name('activite-etape-sauvegarder');

// activite-sauvegarder-ecoute
Route::any('/activite-etape-sauvegarder-ecoute', 'ActiviteController@sauvegarder_ecoute')->name('activite-etape-sauvegarder-ecoute');

// activite-mp3
Route::post('/activite-mp3', 'ActiviteController@mp3');
Route::get('/activite-mp3', 'ActiviteController@redirect');

// activite-quitter (suppression de l'enregistrement)
Route::get('/activite-etape-quitter', 'ActiviteController@quitter')->name('activite-etape-quitter');

// activite-refaire (suppression de l'enregistrement pour nouvel enregistrement)
Route::get('/activite-etape-refaire', 'ActiviteController@refaire')->name('activite-etape-refaire');

// activite-status
Route::any('/console/activite-statut/{activite_id}', 'ActiviteController@activite_statut')->name('activite-statut');
Route::any('/console/activite-statut', 'ActiviteController@redirect');

// activite-enregistrement-status : vu / non vu
Route::post('/console/activite-enregistrement-statut/{enregistrement_id}', 'ActiviteController@enregistrement_statut')->name('activite-enregistrement-status');
Route::any('/console/activite-enregistrement-statut', 'ActiviteController@redirect');

// activite-archiver
Route::any('/console/activite-archiver/{activite_id}', 'ActiviteController@activite_archiver')->name('activite-archiver');
Route::any('/console/activite-archiver', 'ActiviteController@redirect');

// activites-archives
Route::get('/console/activites-archives', function(){
	return view('activites')->with('is_archive', 1);
});


// ============================================================================
// == ENTRAINEMENTS - CONSOLE
// ============================================================================

// entrainement-liste
Route::any('/console/entrainements', 'ConsoleController@entrainements_liste')->name('entrainements-liste');

// entrainement-creer
Route::get('/console/entrainement-creer', 'ConsoleController@entrainement_creer')->name('entrainement-creer');
Route::post('/console/entrainement-creer', 'ConsoleController@entrainement_creer_post')->name('entrainement-creer-post');

// entrainement-modifier
Route::get('/console/entrainement-modifier/{entrainement_id}', 'ConsoleController@entrainement_modifier_get')->name('entrainement-modifier-get');
Route::get('/console/entrainement-modifier', 'ConsoleController@redirect');
Route::post('/console/entrainement-modifier', 'ConsoleController@entrainement_modifier_post')->name('entrainement-modifier-post');

// entrainement-afficher
Route::any('/console/entrainement-afficher/{entrainement_id}', 'ConsoleController@entrainement_afficher_any')->name('entrainement-afficher-any');
Route::any('/console/entrainement-afficher', 'ConsoleController@redirect');

// entrainement-afficher DEV
Route::any('/console/entrainement-afficher-dev/{entrainement_id}', 'ConsoleController@entrainement_afficher_dev')->name('entrainement-afficher-dev');


// entrainement-status
Route::any('/console/entrainement-statut/{entrainement_id}', 'ConsoleController@entrainement_statut')->name('entrainement-statut');
Route::any('/console/entrainement-statut', 'ConsoleController@redirect');

// enregistrement-status : vu / non vu
Route::post('/console/enregistrement-statut/{enregistrement_id}', 'ConsoleController@enregistrement_statut')->name('enregistrement-statut');
Route::any('/console/enregistrement-statut', 'ConsoleController@redirect');

// entrainement-archiver
Route::any('/console/entrainement-archiver/{entrainement_id}', 'ConsoleController@entrainement_archiver')->name('entrainement-archiver');
Route::any('/console/entrainement-archiver', 'ConsoleController@redirect');

// entrainements-archives
Route::get('/console/entrainements-archives', function(){
	return view('entrainements')->with('is_archive', 1);
});

// entrainement-correction-creer
Route::get('/console/entrainement-correction-creer', 'ConsoleController@redirect');
Route::post('/console/entrainement-correction-creer', 'ConsoleController@entrainement_correction_creer_post')->name('entrainement-correction-creer-post');

// entrainement-correction-supprimer
Route::get('/console/entrainement-correction-supprimer/{correction_id}', 'ConsoleController@entrainement_correction_supprimer')->name('entrainement-correction-supprimer');
Route::get('/console/entrainement-correction-supprimer', 'CommentaireController@redirect');

// ============================================================================
// == ENTRAINEMENTS - ELEVES
// ============================================================================

// entrainement-etape1 - prenom, nom, code
Route::get('/entrainement', 'EntrainementController@etape1')->name('entrainement-etape1');
Route::get('/e/{code}', function($code){
	return view('entrainement-etape1')->with('code', $code);
});
Route::post('/e/{code}', 'EntrainementController@etape1Post');
Route::post('/entrainement', 'EntrainementController@etape1Post');

// entrainement-etape1bis - sujets grand oral / brevet
Route::get('/entrainement-etape1bis', 'EntrainementController@etape1bis_get')->name('entrainement-etape1bis_get');
Route::post('/entrainement-etape1bis', 'EntrainementController@etape1bis_post')->name('entrainement-etape1bis_post');

// entrainement-etape2 - test audio
Route::get('/entrainement-etape2', 'EntrainementController@etape2')->name('entrainement-etape2');
Route::post('/entrainement-etape2', 'EntrainementController@etape2NouvelEssai');

// entrainement-etape3
Route::any('/entrainement-etape3', 'EntrainementController@etape3')->name('entrainement-etape3');

// entrainement-etape3
Route::any('/entrainement-etape4', 'EntrainementController@etape4')->name('entrainement-etape4');

// entrainement-etape5
Route::any('/entrainement-etape5', 'EntrainementController@etape5')->name('entrainement-etape5');

// entrainement-inactif
Route::any('/entrainement-inactif', 'EntrainementController@inactif')->name('entrainement-inactif');

// entrainement-erreur1
Route::any('/entrainement-erreur', 'EntrainementController@erreur')->name('entrainement-erreur');

// entrainement-mp3
Route::post('/entrainement-mp3', 'EntrainementController@mp3');
Route::get('/entrainement-mp3', 'EntrainementController@redirect');

// entrainement-lecteur
Route::any('/entrainement-lecteur', 'EntrainementController@lecteur')->name('entrainement-lecteur');



// ============================================================================
// == TESTS AUDIO
// ============================================================================

// test mp3
Route::post('/test-mp3', 'TestaudioController@mp3');
Route::get('/test-mp3', 'TestaudioController@redirect');

// test lecteur
Route::any('/test-lecteur/{fichier_audio}', 'TestaudioController@lecteur')->name('test-lecteur');
Route::any('/test-lecteur', 'TestaudioController@redirect');



// ============================================================================
// == CONSOLE
// ============================================================================

// Console
Route::post('/console', 'ConsoleController@post');
Route::get('/console', 'ConsoleController@index')->name('console');

// Console - supprimer compte
Route::get('/supprimer', 'ConsoleController@supprimer')->name('supprimer');

// Console - editer
Route::post('/console/editer', 'EditerController@post');
Route::get('/console/editer/{entrainement_id}', 'EditerController@index');
Route::get('/console/editer', 'EditerController@redirect');

// Console - afficher
Route::any('/console/afficher/{entrainement_id}', 'AfficherController@index')->name('afficher');
Route::any('/console/afficher', 'AfficherController@redirect');

// Console - lecteur
Route::any('/console/lecteur/{code_audio}', 'ConsoleController@consolelecteur')->name('consolelecteur');
Route::any('/console/lecteur', 'ConsoleController@redirect');

// Console - lecteur activite
Route::any('/console/lecteur-activite/{code_audio}', 'ConsoleController@lecteur_activite')->name('lecteur-activite');
Route::any('/console/lecteur-activite', 'ConsoleController@redirect');

// Entrainement - ecoute
Route::any('/entrainement/{code_audio}', 'ConsoleController@entrainementecoute')->name('entrainementecoute');
