<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Nouvel utilisateur</title>
</head>
<body>
	<div style="text-align:center;margin:20px;"><a href="https://www.mon-oral.net/admin" style="text-decoration:none;padding:20px;background-color:#3490dc;border-radius:4px;color:white;font-weight:bold;">accepter / refuser</a></div>
	<br />
	<div>Nom : {{ $data->nom }}</div>
	<div>Prénom : {{ $data->prenom }}</div>
	<div>Etablissement : {{ $data->etablissement }}</div>
	<div>Matière : {{ $data->matiere }}</div>
	<div>Email : {{ $data->email }}</div>
</body>
</html>