<!DOCTYPE html>
<html>
<head>
    <title>Statut de votre avis</title>
</head>
<body>
    <h1>Bonjour {{ $tutorName }},</h1>

    <p>Nous vous informons que votre avis intitulé <strong>{{ $opinion->title }}</strong> a été
        @if($opinion->is_approved)
            approuvé.
        @else
            rejeté.
        @endif
    </p>

    <p>Merci pour votre contribution !</p>

    <p>Cordialement,</p>
    <p>{{ config('app.name') }}</p>
</body>
</html>
