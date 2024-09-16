<!DOCTYPE html>
<html>
<head>
    <title>Statut de votre avis</title>
</head>
<body>
    <h1>Bonjour {{ $tutorName }},</h1>

    <p>Nous vous informons que votre avis intitulé <strong>{{ $opinion->title }}</strong> a été rejeté.</p>

    <p><strong>Raison du rejet :</strong> Votre avis a été rejeté car il contient des éléments qui ne respectent pas nos conditions d'utilisation. Cela peut inclure des propos offensants, des discours haineux, des incitations à la violence, ou tout autre contenu inapproprié contraire à notre charte de modération.</p>

    <p>Merci pour votre compréhension et votre contribution !</p>

    <p>Cordialement,</p>
    <p>La Maison Des Enfants</p>
</body>
</html>

