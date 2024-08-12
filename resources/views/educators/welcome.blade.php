<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue sur notre plateforme</title>
</head>
<body>
    <h1>Bienvenue, {{ $user->firstname }} {{ $user->lastname }}!</h1>
    <p>Vous avez été inscrit en tant qu'éducateur sur notre plateforme.</p>
    <p>Voici vos identifiants de connexion :</p>
    <ul>
        <li>Email : {{ $user->email }}</li>
        <li>Mot de passe : {{ $password }}</li>
    </ul>
    <p>Veuillez vous assurer de changer votre mot de passe lors de votre première connexion.</p>
</body>
</html>
