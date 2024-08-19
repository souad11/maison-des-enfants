<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Mail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        p {
            line-height: 1.6;
            margin-bottom: 10px;
        }
        .label {
            font-weight: bold;
            color: #2980b9;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>Vous avez reçu un nouveau message de contact</h1>
        <p><span class="label">Nom :</span> {{ $data['name'] }}</p>
        <p><span class="label">Email :</span> {{ $data['email'] }}</p>
        <p><span class="label">Sujet :</span> {{ $data['subject'] }}</p>
        <p><span class="label">Message :</span></p>
        <p>{{ $data['message'] }}</p>
    </div>
    <div class="footer">
        <p>&copy; {{ date('Y') }} La Maison des enfants. Tous droits réservés.</p>
    </div>
</body>
</html>
